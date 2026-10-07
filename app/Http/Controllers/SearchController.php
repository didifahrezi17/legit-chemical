<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $keyword = trim($request->input('q', ''));

        if (empty($keyword)) {
            return redirect()->route('products.index');
        }

        $products = Product::active()
            ->with('category')
            ->where(function ($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%")
                    ->orWhere('description', 'like', "%{$keyword}%")
                    ->orWhere('specifications', 'like', "%{$keyword}%")
                    ->orWhereHas('category', function ($catQ) use ($keyword) {
                        $catQ->where('name', 'like', "%{$keyword}%");
                    });
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('user.search', compact('products', 'keyword'));
    }
}
