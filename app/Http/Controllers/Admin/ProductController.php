<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category')->latest();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->input('category_id'));
        }

        $products = $query->paginate(10);
        $categories = Category::where('status', 'active')->get();

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::where('status', 'active')->get();

        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'discount_percentage' => 'nullable|integer|min:0|max:100',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'description' => 'nullable|string',
            'specifications' => 'nullable|string',
            'benefits' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ], [
            'name.required' => 'Nama produk wajib diisi.',
            'category_id.required' => 'Kategori produk wajib dipilih.',
            'price.required' => 'Harga produk wajib diisi.',
            'stock.required' => 'Stok produk wajib diisi.',
            'discount_percentage.max' => 'Diskon maksimal 100%.',
            'image.image' => 'File harus berupa gambar.',
            'image.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        // Check unique slug, append random if needed
        if (Product::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] .= '-'.Str::random(5);
        }

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $validated['image'] = $path;
        }

        Product::create($validated);

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function show($id)
    {
        $product = Product::with(['category', 'stockHistories.admin'])->findOrFail($id);

        return view('admin.products.show', compact('product'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::where('status', 'active')->get();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'discount_percentage' => 'nullable|integer|min:0|max:100',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'description' => 'nullable|string',
            'specifications' => 'nullable|string',
            'benefits' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ], [
            'name.required' => 'Nama produk wajib diisi.',
            'category_id.required' => 'Kategori produk wajib dipilih.',
            'price.required' => 'Harga produk wajib diisi.',
            'stock.required' => 'Stok produk wajib diisi.',
            'discount_percentage.max' => 'Diskon maksimal 100%.',
            'image.image' => 'File harus berupa gambar.',
            'image.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        if ($product->name !== $validated['name']) {
            $slug = Str::slug($validated['name']);
            if (Product::where('slug', $slug)->where('id', '!=', $product->id)->exists()) {
                $slug .= '-'.Str::random(5);
            }
            $validated['slug'] = $slug;
        }

        if ($request->hasFile('image')) {
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $path = $request->file('image')->store('products', 'public');
            $validated['image'] = $path;
        }

        $product->update($validated);

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil dihapus.');
    }
}
