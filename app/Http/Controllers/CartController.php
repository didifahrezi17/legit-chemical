<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Services\WhatsAppService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $totalEstimate = 0;

        foreach ($cart as $item) {
            $totalEstimate += $item['subtotal'];
        }

        return view('user.cart.index', compact('cart', 'totalEstimate'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::active()->with('category')->findOrFail($request->product_id);

        if ($product->stock <= 0) {
            return back()->with('error', 'Stok produk ini sedang habis.');
        }

        $cart = session()->get('cart', []);
        $productId = $product->id;
        $qty = (int) $request->quantity;

        if (isset($cart[$productId])) {
            $newQty = $cart[$productId]['quantity'] + $qty;
            if ($newQty > $product->stock) {
                $newQty = $product->stock;
            }
            $cart[$productId]['quantity'] = $newQty;
            $cart[$productId]['subtotal'] = $cart[$productId]['price'] * $newQty;
        } else {
            if ($qty > $product->stock) {
                $qty = $product->stock;
            }
            $cart[$productId] = [
                'id' => $product->id,
                'name' => $product->name,
                'slug' => $product->slug,
                'price' => (float) $product->price,
                'quantity' => $qty,
                'image' => $product->image,
                'subtotal' => (float) ($product->price * $qty),
                'stock' => $product->stock,
                'category_name' => $product->category ? $product->category->name : 'General',
            ];
        }

        session()->put('cart', $cart);

        if ($request->wantsJson()) {
            $count = array_sum(array_column($cart, 'quantity'));

            return response()->json([
                'success' => true,
                'message' => 'Produk berhasil ditambahkan ke keranjang!',
                'cart_count' => $count,
            ]);
        }

        return redirect()->back()->with('success', "'{$product->name}' berhasil ditambahkan ke keranjang.");
    }

    public function update(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'quantity' => 'required|integer|min:1',
        ]);

        $productId = $request->product_id;
        $quantity = (int) $request->quantity;
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $product = Product::find($productId);
            if ($product && $quantity > $product->stock) {
                $quantity = $product->stock;
            }

            $cart[$productId]['quantity'] = $quantity;
            $cart[$productId]['subtotal'] = $cart[$productId]['price'] * $quantity;

            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Keranjang berhasil diperbarui.');
    }

    public function remove(Request $request)
    {
        $productId = $request->input('product_id');
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Produk berhasil dihapus dari keranjang.');
    }

    public function clear()
    {
        session()->forget('cart');

        return redirect()->route('cart.index')->with('info', 'Keranjang telah dikosongkan.');
    }

    /**
     * Checkout Cart via WhatsApp
     * Creates Order record (status: 'konsultasi'), then redirects to encoded wa.me URL
     */
    public function checkoutWhatsApp()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang Anda masih kosong.');
        }

        $totalEstimate = 0;
        foreach ($cart as $item) {
            $totalEstimate += $item['subtotal'];
        }

        // Generate Order Code
        $orderCode = 'ORD-'.date('Ymd').'-'.strtoupper(Str::random(4));

        // Create Order in DB (status: 'konsultasi', NO stock deduction yet!)
        $order = Order::create([
            'order_code' => $orderCode,
            'total' => $totalEstimate,
            'status' => 'konsultasi',
            'notes' => 'Konsultasi awal dari Keranjang Website',
        ]);

        foreach ($cart as $item) {
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'subtotal' => $item['subtotal'],
            ]);
        }

        // Generate WhatsApp Message & URL
        $message = WhatsAppService::generateCartMessage($cart, $totalEstimate);
        $waUrl = WhatsAppService::generateUrl($message);

        // Clear cart session
        session()->forget('cart');

        return redirect()->away($waUrl);
    }

    /**
     * Single Product Direct WhatsApp Consultation
     */
    public function directWhatsApp(Request $request, $id)
    {
        $quantity = (int) $request->input('quantity', 1);
        $product = Product::active()->findOrFail($id);

        $orderCode = 'ORD-'.date('Ymd').'-'.strtoupper(Str::random(4));
        $subtotal = $product->price * $quantity;

        $order = Order::create([
            'order_code' => $orderCode,
            'total' => $subtotal,
            'status' => 'konsultasi',
            'notes' => 'Konsultasi langsung halaman detail produk',
        ]);

        OrderDetail::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'quantity' => $quantity,
            'price' => $product->price,
            'subtotal' => $subtotal,
        ]);

        $message = WhatsAppService::generateSingleProductMessage($product, $quantity);
        $waUrl = WhatsAppService::generateUrl($message);

        return redirect()->away($waUrl);
    }
}
