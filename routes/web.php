<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SearchController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| USER ROUTES (No login required)
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/produk', [ProductController::class, 'index'])->name('products.index');
Route::get('/produk/{slug}', [ProductController::class, 'show'])->name('products.show');
Route::post('/produk/{id}/direct-wa', [CartController::class, 'directWhatsApp'])->name('products.direct_wa');

Route::get('/search', [SearchController::class, 'index'])->name('search');
Route::get('/tentang-kami', [AboutController::class, 'index'])->name('about');
Route::get('/kontak', [ContactController::class, 'index'])->name('contact');

// Cart Routes (Session based)
Route::get('/keranjang', [CartController::class, 'index'])->name('cart.index');
Route::post('/keranjang/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/keranjang/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/keranjang/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/keranjang/clear', [CartController::class, 'clear'])->name('cart.clear');
Route::post('/keranjang/checkout', [CartController::class, 'checkoutWhatsApp'])->name('cart.checkout');

/*
|--------------------------------------------------------------------------
| ADMIN AUTHENTICATION ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

/*
|--------------------------------------------------------------------------
| ADMIN PROTECTED DASHBOARD ROUTES
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware(AdminMiddleware::class)->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Categories CRUD
    Route::get('/kategori', [AdminCategoryController::class, 'index'])->name('kategori.index');
    Route::get('/kategori/create', [AdminCategoryController::class, 'create'])->name('kategori.create');
    Route::post('/kategori', [AdminCategoryController::class, 'store'])->name('kategori.store');
    Route::get('/kategori/{id}/edit', [AdminCategoryController::class, 'edit'])->name('kategori.edit');
    Route::put('/kategori/{id}', [AdminCategoryController::class, 'update'])->name('kategori.update');
    Route::delete('/kategori/{id}', [AdminCategoryController::class, 'destroy'])->name('kategori.destroy');

    // Products CRUD
    Route::get('/produk', [AdminProductController::class, 'index'])->name('produk.index');
    Route::get('/produk/create', [AdminProductController::class, 'create'])->name('produk.create');
    Route::post('/produk', [AdminProductController::class, 'store'])->name('produk.store');
    Route::get('/produk/{id}', [AdminProductController::class, 'show'])->name('produk.show');
    Route::get('/produk/{id}/edit', [AdminProductController::class, 'edit'])->name('produk.edit');
    Route::put('/produk/{id}', [AdminProductController::class, 'update'])->name('produk.update');
    Route::delete('/produk/{id}', [AdminProductController::class, 'destroy'])->name('produk.destroy');

    // Order & Consultation Management
    Route::get('/pesanan', [AdminOrderController::class, 'index'])->name('pesanan.index');
    Route::get('/pesanan/{id}', [AdminOrderController::class, 'show'])->name('pesanan.show');
    Route::put('/pesanan/{id}/konfirmasi', [AdminOrderController::class, 'confirm'])->name('pesanan.konfirmasi');
    Route::put('/pesanan/{id}/selesai', [AdminOrderController::class, 'complete'])->name('pesanan.selesai');
    Route::put('/pesanan/{id}/batal', [AdminOrderController::class, 'cancel'])->name('pesanan.batal');

    // Order History (Riwayat Pesanan)
    Route::get('/riwayat-pesanan', [AdminOrderController::class, 'history'])->name('riwayat_pesanan.index');

    // Admin Profile
    Route::get('/profile', [AdminProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [AdminProfileController::class, 'update'])->name('profile.update');
});
