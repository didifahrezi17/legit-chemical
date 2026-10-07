@extends('layouts.app')

@section('title', 'Katalog Produk - LEGIT CHEMICAL')

@section('content')
<div class="container py-4">
    <!-- BREADCRUMB -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb mb-0 small">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none text-muted">Home</a></li>
            <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">Produk</li>
        </ol>
    </nav>

    <div class="row g-4">
        <!-- SIDEBAR KATEGORI -->
        <div class="col-lg-3">
            <div class="card border-0 shadow-sm p-3" style="border-radius: 12px; background: #FFFFFF;">
                <h6 class="fw-bold mb-3 text-dark font-poppins">Kategori</h6>
                <div class="list-group list-group-flush">
                    <a href="{{ route('products.index') }}"
                       class="list-group-item list-group-item-action border-0 rounded-3 mb-1 font-weight-500 {{ !$selectedCategory ? 'active-category' : '' }}"
                       style="padding: 0.65rem 1rem;">
                       Semua Kategori
                    </a>
                    @foreach($categories as $cat)
                        <a href="{{ route('products.index', ['category' => $cat->slug]) }}"
                           class="list-group-item list-group-item-action border-0 rounded-3 mb-1 font-weight-500 d-flex justify-content-between align-items-center {{ $selectedCategory == $cat->slug ? 'active-category' : '' }}"
                           style="padding: 0.65rem 1rem;">
                           <span>{{ $cat->name }}</span>
                           <span class="badge bg-light text-secondary rounded-pill">{{ $cat->products_count }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- MAIN PRODUCT CATALOG AREA -->
        <div class="col-lg-9">
            <!-- TOP BAR SEARCH & SORT -->
            <div class="card border-0 shadow-sm p-3 mb-4" style="border-radius: 12px;">
                <form action="{{ route('products.index') }}" method="GET" class="row g-2 align-items-center">
                    @if($selectedCategory)
                        <input type="hidden" name="category" value="{{ $selectedCategory }}">
                    @endif

                    <div class="col-md-7 col-lg-8">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-search"></i></span>
                            <input type="text" name="q" class="form-control border-start-0" placeholder="Cari produk..." value="{{ request('q') }}">
                        </div>
                    </div>

                    <div class="col-md-5 col-lg-4">
                        <select name="sort" class="form-select" onchange="this.form.submit()">
                            <option value="terbaru" {{ $sort == 'terbaru' ? 'selected' : '' }}>Terbaru</option>
                            <option value="harga_asc" {{ $sort == 'harga_asc' ? 'selected' : '' }}>Harga: Terendah</option>
                            <option value="harga_desc" {{ $sort == 'harga_desc' ? 'selected' : '' }}>Harga: Tertinggi</option>
                            <option value="nama_asc" {{ $sort == 'nama_asc' ? 'selected' : '' }}>Nama: A - Z</option>
                        </select>
                    </div>
                </form>
            </div>

            <!-- PRODUCT GRID -->
            @if($products->count() > 0)
                <div class="row g-4 mb-4">
                    @foreach($products as $product) 
                        <div class="col-12 col-sm-6 col-md-4">
                            <div class="product-card">
                                <div class="product-img-wrapper">
                                <a href="{{ route('products.show', $product->slug) }}">
                                    @if($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                                    @else
                                        <img src="https://via.placeholder.com/400x350/F8FAFC/0B3B82?text=LC+Chemical" alt="{{ $product->name }}">
                                    @endif
                                </a>
                                </div>
                                <div class="product-card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-1">
                                        <span class="product-category text-truncate me-1">{{ $product->category->name ?? 'General' }}</span>
                                        <span class="badge {{ $product->stock_badge_class }} px-2 py-1" style="font-size: 0.7rem;">{{ $product->stock_status }}</span>
                                    </div>
                                    <h6 class="product-title text-truncate" title="{{ $product->name }}">{{ $product->name }}</h6>
                                    @if($product->has_discount)
                                        <div class="d-flex align-items-center gap-1 mb-1">
                                            <span class="badge bg-danger" style="font-size:0.68rem;">-{{ $product->discount_percentage }}%</span>
                                            <del class="text-muted" style="font-size:0.8rem;">{{ $product->formatted_original_price }}</del>
                                        </div>
                                        <div class="product-price mb-3" style="color:#D00000;">{{ $product->formatted_price }}</div>
                                    @else
                                        <div class="product-price mb-3">{{ $product->formatted_price }}</div>
                                    @endif

                                    <div class="mt-auto d-flex flex-column gap-2">
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('products.show', $product->slug) }}" class="btn btn-navy btn-sm flex-grow-1 py-1" style="font-size: 0.85rem;">
                                                Detail
                                            </a>
                                            <!-- Add to Cart Form -->
                                            <form action="{{ route('cart.add') }}" method="POST" class="add-to-cart-form">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <input type="hidden" name="quantity" value="1">
                                                <button type="submit" class="btn btn-outline-secondary btn-sm px-2 py-1" title="Tambah ke Keranjang" {{ $product->stock <= 0 ? 'disabled' : '' }}>
                                                    <i class="bi bi-cart-plus fs-6"></i>
                                                </button>
                                            </form>
                                        </div>

                                        @if($product->stock > 0)
                                            <form action="{{ route('products.direct_wa', $product->id) }}" method="POST" target="_blank">
                                                @csrf
                                                <button type="submit" class="btn btn-wa btn-sm w-100 py-1" style="font-size: 0.82rem;">
                                                    <i class="bi bi-whatsapp"></i> Pesan Sekarang
                                                </button>
                                            </form>
                                        @else
                                            <button class="btn btn-secondary btn-sm w-100 py-1" disabled style="font-size: 0.82rem;">
                                                Stok Habis
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- PAGINATION -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $products->links() }}
                </div>
            @else
                <div class="card border-0 shadow-sm text-center p-5" style="border-radius: 16px; background: #FFFFFF;">
                    <div class="mb-3">
                        <img src="{{ asset('images/no-product.svg') }}" alt="Produk Tidak Ditemukan" style="max-height: 140px; width: auto;">
                    </div>
                    <h5 class="fw-bold text-dark font-poppins">Produk Tidak Ditemukan</h5>
                    <p class="text-muted">Maaf, tidak ada produk yang cocok dengan pencarian atau filter yang Anda pilih.</p>
                    <div class="mt-2">
                        <a href="{{ route('products.index') }}" class="btn btn-navy btn-sm px-4 py-2 font-poppins fw-semibold shadow-sm">
                            Lihat Semua Produk
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

@push('styles')
<style>
    .active-category {
        background-color: #EBF3FC !important;
        color: var(--primary-navy) !important;
        font-weight: 700 !important;
    }
</style>
@endpush
@endsection
