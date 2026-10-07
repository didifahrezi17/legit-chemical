@extends('layouts.app')

@section('title', 'Hasil Pencarian: ' . $keyword . ' - LEGIT CHEMICAL')

@section('content')
<div class="container py-4">
    <!-- BREADCRUMB -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb mb-0 small">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none text-muted">Home</a></li>
            <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">Pencarian</li>
        </ol>
    </nav>

    <div class="mb-4">
        <h4 class="fw-bold text-dark font-poppins mb-1">Hasil Pencarian</h4>
        <p class="text-muted">Menampilkan hasil untuk kata kunci: <span class="fw-semibold text-primary">"{{ $keyword }}"</span></p>
    </div>

    @if($products->count() > 0)
        <div class="row g-4 mb-4">
            @foreach($products as $product)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="product-card">
                        <div class="product-img-wrapper">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                            @else
                                <img src="https://via.placeholder.com/400x350/F8FAFC/0B3B82?text=LC+Chemical" alt="{{ $product->name }}">
                            @endif
                        </div>
                        <div class="product-card-body">
                            <div class="d-flex justify-content-between align-items-start mb-1">
                                <span class="product-category text-truncate me-1">{{ $product->category->name ?? 'General' }}</span>
                                <span class="badge {{ $product->stock_badge_class }} px-2 py-1" style="font-size: 0.7rem;">{{ $product->stock_status }}</span>
                            </div>
                            <h6 class="product-title text-truncate">{{ $product->name }}</h6>
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
                                <a href="{{ route('products.show', $product->slug) }}" class="btn btn-navy btn-sm w-100 py-1" style="font-size: 0.85rem;">
                                    Detail
                                </a>
                                @if($product->stock > 0)
                                    <form action="{{ route('products.direct_wa', $product->id) }}" method="POST" target="_blank">
                                        @csrf
                                        <button type="submit" class="btn btn-wa btn-sm w-100 py-1" style="font-size: 0.82rem;">
                                            <i class="bi bi-whatsapp"></i> Pesan Sekarang
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $products->links() }}
        </div>
    @else
        <div class="card border-0 shadow-sm text-center py-5 px-4" style="border-radius: 16px; background: #FFFFFF;">
            <div class="mb-3">
                <img src="{{ asset('images/no-product.svg') }}" alt="Produk Tidak Ditemukan" style="max-height: 150px; width: auto;">
            </div>
            <h4 class="fw-bold text-dark font-poppins">Produk Tidak Ditemukan</h4>
            <p class="text-muted mb-4">Tidak ada produk yang cocok dengan kata kunci "{{ $keyword }}". Coba cari kata kunci lain.</p>
            <div>
                <a href="{{ route('products.index') }}" class="btn btn-navy px-4 py-2 font-poppins fw-semibold shadow-sm">
                    Lihat Semua Produk
                </a>
            </div>
        </div>
    @endif
</div>
@endsection
