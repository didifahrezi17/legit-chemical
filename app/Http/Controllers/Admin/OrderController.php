<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\StockHistory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('orderDetails.product')->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('order_code', 'like', "%{$search}%");
        }

        $orders = $query->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with(['orderDetails.product.category'])->findOrFail($id);

        return view('admin.orders.show', compact('order'));
    }

    /**
     * Halaman Riwayat Pesanan dengan Filter dan Pencarian
     */
    public function history(Request $request)
    {
        $query = Order::with('orderDetails.product')->latest();

        // Filter status jika dipilih
        if ($request->filled('status') && $request->input('status') !== 'semua') {
            $query->where('status', $request->input('status'));
        }

        // Pencarian berdasarkan kode pesanan
        if ($request->filled('search')) {
            $search = trim($request->input('search'));
            $query->where('order_code', 'like', "%{$search}%");
        }

        $orders = $query->paginate(10)->withQueryString();

        return view('admin.orders.history', compact('orders'));
    }

    /**
     * Konfirmasi Pesanan dan Kurangi Stok (Protected by DB::transaction)
     */
    public function confirm($id)
    {
        $order = Order::with('orderDetails.product')->findOrFail($id);

        if ($order->status === 'dikonfirmasi') {
            return redirect()->back()->with('warning', 'Pesanan ini sudah dikonfirmasi sebelumnya. Stok tidak dikurangi ulang.');
        }

        if ($order->status === 'selesai' || $order->status === 'dibatalkan') {
            return redirect()->back()->with('error', "Status pesanan sudah '{$order->status_label}', tidak dapat dikonfirmasi.");
        }

        try {
            DB::transaction(function () use ($order) {
                // Lock order row
                $orderLocked = Order::lockForUpdate()->findOrFail($order->id);

                if ($orderLocked->status === 'dikonfirmasi') {
                    throw new Exception('Pesanan sudah dikonfirmasi oleh sesi lain.');
                }

                // Check stock for all items
                foreach ($orderLocked->orderDetails as $detail) {
                    $product = Product::lockForUpdate()->findOrFail($detail->product_id);
                    if ($product->stock < $detail->quantity) {
                        throw new Exception("Stok produk '{$product->name}' tidak mencukupi. (Stok tersedia: {$product->stock}, dibutuhkan: {$detail->quantity})");
                    }
                }

                // Deduct stock and record history
                foreach ($orderLocked->orderDetails as $detail) {
                    $product = Product::lockForUpdate()->findOrFail($detail->product_id);
                    $stockBefore = $product->stock;
                    $stockAfter = $stockBefore - $detail->quantity;

                    $product->update(['stock' => $stockAfter]);

                    StockHistory::create([
                        'product_id' => $product->id,
                        'admin_id' => Auth::guard('admin')->id(),
                        'type' => 'keluar',
                        'quantity' => $detail->quantity,
                        'stock_before' => $stockBefore,
                        'stock_after' => $stockAfter,
                        'note' => "Pengurangan stok otomatis untuk pesanan #{$orderLocked->order_code}",
                    ]);
                }

                $orderLocked->update(['status' => 'dikonfirmasi']);
            });

            return redirect()->route('admin.pesanan.show', $order->id)
                ->with('success', "Pesanan #{$order->order_code} berhasil dikonfirmasi dan stok produk telah dikurangi.");

        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function complete($id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => 'selesai']);

        return redirect()->route('admin.pesanan.show', $order->id)
            ->with('success', "Pesanan #{$order->order_code} ditandai Selesai.");
    }

    public function cancel($id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => 'dibatalkan']);

        return redirect()->route('admin.pesanan.show', $order->id)
            ->with('info', "Pesanan #{$order->order_code} telah dibatalkan.");
    }
}
