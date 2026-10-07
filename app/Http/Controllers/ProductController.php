<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::active()->withCount(['products' => function ($q) {
            $q->where('status', 'active');
        }])->get();

        $query = Product::active()->with('category');

        // Category filter
        if ($request->filled('category')) {
            $categorySlug = $request->input('category');
            $query->whereHas('category', function ($q) use ($categorySlug) {
                $q->where('slug', $categorySlug);
            });
        }

        // Search query
        if ($request->filled('q')) {
            $keyword = $request->input('q');
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%")
                    ->orWhere('description', 'like', "%{$keyword}%")
                    ->orWhere('specifications', 'like', "%{$keyword}%");
            });
        }

        // Sorting
        $sort = $request->input('sort', 'terbaru');
        match ($sort) {
            'harga_asc' => $query->orderBy('price', 'asc'),
            'harga_desc' => $query->orderBy('price', 'desc'),
            'nama_asc' => $query->orderBy('name', 'asc'),
            default => $query->latest(),
        };

        $products = $query->paginate(9)->withQueryString();
        $selectedCategory = $request->input('category');

        return view('user.products.index', compact('categories', 'products', 'selectedCategory', 'sort'));
    }

    public function category($slug)
    {
        $category = Category::active()->where('slug', $slug)->firstOrFail();
        $categories = Category::active()->withCount(['products' => function ($q) {
            $q->where('status', 'active');
        }])->get();

        $products = Product::active()
            ->where('category_id', $category->id)
            ->with('category')
            ->latest()
            ->paginate(9);

        $selectedCategory = $slug;
        $sort = 'terbaru';

        return view('user.products.index', compact('categories', 'products', 'selectedCategory', 'sort', 'category'));
    }

    public function show($slug)
    {
        $product = Product::active()->with('category')->where('slug', $slug)->firstOrFail();
        $relatedProducts = Product::active()
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        return view('user.products.show', compact('product', 'relatedProducts'));
    }
}
