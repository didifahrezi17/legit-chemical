@extends('layouts.app')

@section('title', 'LEGIT CHEMICAL - Solusi Kebutuhan Chemical & Industri')

@section('content')

<!-- HERO SECTION -->
<section class="hero-section">
    
    <!-- Background Image -->
    <div class="hero-bg"></div>

    <!-- Overlay -->
    <div class="hero-overlay"></div>

    <div class="container position-relative hero-content">
        <div class="row align-items-center">
            
            <!-- TEXT -->
            <div class="col-lg-7">
                <h1 class="fw-bold mb-3 display-5 text-dark"
                    style="font-family: 'Poppins', sans-serif; line-height: 1.2;">
                    Solusi Kebutuhan <br>
                    <span style="color: var(--primary-navy);">
                        Chemical &amp; Industri
                    </span>
                </h1>

                <p class="text-secondary mb-4 fs-5"
                   style="max-width: 520px; line-height: 1.6;">
                    Menyediakan berbagai kebutuhan bahan kimia,
                    hardware, bahan &amp; bibit, laundry, home care,
                    car care, dan kebutuhan lainnya dengan kualitas terbaik.
                </p>

                <div class="d-flex gap-3">
                    <a href="{{ route('products.index') }}"
                       class="btn btn-navy px-4 py-3 fs-6 shadow-sm">
                        <i class="bi bi-grid-fill me-2"></i>
                        Lihat Produk
                    </a>

                    <a href="https://wa.me/{{ env('WHATSAPP_ADMIN', '6281234567890') }}"
                       target="_blank"
                       class="btn btn-success px-4 py-3 fs-6 fw-semibold"
                       style="border-radius: 8px;">
                        <i class="bi bi-whatsapp me-2"></i>
                        Hubungi Kami
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>



<!-- BEST SELLING PRODUCTS SECTION -->
<section class="py-5" style="background: linear-gradient(180deg, #F5F7FA 0%, #FFFFFF 100%);">
    <div class="container py-2">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <div class="d-flex align-items-center gap-2 mb-1">
                    <span style="font-size: 1.5rem;">🔥</span>
                    <h3 class="fw-bold text-dark mb-0" style="font-family: 'Poppins', sans-serif;">Produk Terlaris</h3>
                </div>
                <p class="text-muted mb-0">Produk paling banyak dipesan oleh pelanggan kami</p>
            </div>
            <a href="{{ route('products.index') }}" class="btn btn-link text-decoration-none fw-semibold p-0" style="color: var(--primary-navy);">
                Lihat Semua <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>

        <div class="row g-4">
            @forelse($bestSellingProducts as $product)
                <div class="col-12 col-sm-6 col-md-4 col-lg-2-4" style="flex: 0 0 auto; width: 20%;">
                    <div class="product-card position-relative">
                        @if($product->total_sold > 0)
                            <span class="badge position-absolute top-0 start-0 m-2 px-2 py-1" style="background-color: #FF4500; font-size: 0.7rem; z-index:2; border-radius:6px;">
                                🔥 {{ $product->total_sold }} Terjual
                            </span>
                        @endif
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
                                <a href="{{ route('products.show', $product->slug) }}" class="btn btn-navy btn-sm w-100 py-1" style="font-size: 0.85rem;">
                                    Detail
                                </a>
                                @if($product->stock > 0)
                                <a href="{{ route('products.show', $product->slug) }}"
                                  class="btn btn-wa btn-sm w-100 py-1"
                                  style="font-size: 0.82rem;">
                                 <i class="bi bi-whatsapp"></i> Pesan Sekarang
                                </a>
                                @else
                                    <button class="btn btn-secondary btn-sm w-100 py-1" disabled style="font-size: 0.82rem;">Habis</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-4 text-muted">
                    <i class="bi bi-box-seam fs-1 d-block mb-2 opacity-25"></i>
                    Belum ada produk terlaris
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- LATEST PRODUCTS SECTION -->
<section class="py-5 bg-white">
    <div class="container py-2">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold text-dark mb-1" style="font-family: 'Poppins', sans-serif;">Produk Terbaru</h3>
                <p class="text-muted mb-0">Temukan produk berkualitas tinggi terbaru dari kami</p>
            </div>
            <a href="{{ route('products.index') }}" class="btn btn-link text-decoration-none fw-semibold p-0" style="color: var(--primary-navy);">
                Lihat Semua <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>

        <div class="row g-4">
            @foreach($latestProducts as $product)
                <div class="col-12 col-sm-6 col-md-4 col-lg-2-4" style="flex: 0 0 auto; width: 20%;">
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
                                @else
                                    <button class="btn btn-secondary btn-sm w-100 py-1" disabled style="font-size: 0.82rem;">
                                        Habis
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

@push('styles')
<style>
    @media (max-width: 1200px) {
        .col-lg-2-4 {
            width: 33.333% !important;
        }
    }
    @media (max-width: 768px) {
        .col-lg-2-4 {
            width: 50% !important;
        }
    }
    @media (max-width: 576px) {
        .col-lg-2-4 {
            width: 100% !important;
        }
    }
    .transition-hover {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .transition-hover:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.08) !important;
    }
</style>
@endpush

@endsection
