<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. STATISTIK UTAMA (REAL DATA DARI DATABASE)
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $ordersThisMonth = Order::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        // Penghasilan Bulan Ini (hanya pesanan terkonfirmasi atau selesai)
        $revenueThisMonthRaw = Order::whereIn('status', ['dikonfirmasi', 'selesai'])
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('total');
        $revenueThisMonth = 'Rp '.number_format((float) $revenueThisMonthRaw, 0, ',', '.');

        // 2. PRODUK PALING BANYAK DIPESAN (TOP 5 TERJUAL, PESANAN DIBATALKAN TIDAK DIHITUNG)
        $topProducts = DB::table('order_details')
            ->join('orders', 'order_details.order_id', '=', 'orders.id')
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->where('orders.status', '!=', 'dibatalkan')
            ->select(
                'products.id',
                'products.name',
                'products.image',
                'products.price',
                'products.stock',
                'categories.name as category_name',
                DB::raw('SUM(order_details.quantity) as total_sold'),
                DB::raw('SUM(order_details.subtotal) as total_revenue')
            )
            ->groupBy('products.id', 'products.name', 'products.image', 'products.price', 'products.stock', 'categories.name')
            ->orderByDesc('total_sold')
            ->take(5)
            ->get();

        // 3. PENGHASILAN BULANAN (GRAFIK 12 BULAN TAHUN BERJALAN)
        $currentYear = now()->year;
        $monthlyRevenueQuery = Order::whereIn('status', ['dikonfirmasi', 'selesai'])
            ->whereYear('created_at', $currentYear)
            ->select(
                DB::raw('MONTH(created_at) as month_num'),
                DB::raw('SUM(total) as monthly_total')
            )
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->pluck('monthly_total', 'month_num')
            ->all();

        $monthNames = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember',
        ];

        $chartLabels = [];
        $chartData = [];
        $monthlySummary = [];

        foreach ($monthNames as $num => $name) {
            $val = (float) ($monthlyRevenueQuery[$num] ?? 0);
            $chartLabels[] = $name;
            $chartData[] = $val;
            $monthlySummary[] = [
                'month' => $name,
                'revenue' => $val,
                'formatted' => 'Rp '.number_format($val, 0, ',', '.'),
            ];
        }

        $totalAnnualRevenue = array_sum($chartData);
        $formattedAnnualRevenue = 'Rp '.number_format($totalAnnualRevenue, 0, ',', '.');

        // 4. PESANAN TERBARU (5 PESANAN TERAKHIR)
        $latestOrders = Order::with('orderDetails.product')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalOrders',
            'ordersThisMonth',
            'revenueThisMonth',
            'revenueThisMonthRaw',
            'topProducts',
            'chartLabels',
            'chartData',
            'monthlySummary',
            'totalAnnualRevenue',
            'formattedAnnualRevenue',
            'latestOrders',
            'currentYear'
        ));
    }
}
