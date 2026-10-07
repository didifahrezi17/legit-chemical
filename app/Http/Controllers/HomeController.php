<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::active()->get();
        $latestProducts = Product::active()->with('category')->latest()->take(6)->get();

        $bestSellingProducts = Product::active()
            ->with('category')
            ->withCount([
                'orderDetails as total_sold' => function ($query) {
                    $query->whereHas('order', function ($q) {
                        $q->whereIn('status', ['dikonfirmasi', 'selesai']);
                    });
                },
            ])
            ->orderByDesc('total_sold')
            ->take(6)
            ->get();

        return view('user.home', compact('categories', 'latestProducts', 'bestSellingProducts'));
    }
}
