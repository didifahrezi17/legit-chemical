@extends('layouts.app')

@section('title', $product->name . ' - LEGIT CHEMICAL')

@section('content')
<div class="container py-4">
    <!-- BREADCRUMB -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb mb-0 small">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none text-muted">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('products.index') }}" class="text-decoration-none text-muted">Produk</a></li>
            <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">{{ $product->name }}</li>
        </ol>
    </nav>

    <div class="card border-0 shadow-sm p-4 mb-5" style="border-radius: 12px; background: #FFFFFF;">
        <div class="row g-4">
            <!-- PRODUCT GALLERY -->
            <div class="col-lg-5">
                <div class="border rounded-3 p-2 bg-light mb-3 text-center position-relative overflow-hidden" style="max-height: 380px;">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" id="mainProductImage" alt="{{ $product->name }}" class="img-fluid rounded" style="max-height: 360px; object-fit: contain;">
                    @else
                        <img src="https://via.placeholder.com/400x400/F8FAFC/0B3B82?text=LC+Chemical" id="mainProductImage" alt="{{ $product->name }}" class="img-fluid rounded" style="max-height: 360px; object-fit: contain;">
                    @endif
                </div>

                <!-- THUMBNAILS -->
                <div class="d-flex gap-2 justify-content-center">
                    <div class="border rounded p-1 bg-white cursor-pointer" onclick="changeImage(this.children[0].src)">
                        <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/100x100/F8FAFC/0B3B82?text=LC' }}" style="width: 60px; height: 60px; object-fit: cover;" class="rounded">
                    </div>
                </div>
            </div>

            <!-- PRODUCT INFO -->
            <div class="col-lg-7">
                <h2 class="fw-bold text-dark mb-2" style="font-family: 'Poppins', sans-serif;">{{ $product->name }}</h2>
                <p class="text-muted mb-3">Kategori: <a href="{{ route('products.index', ['category' => $product->category->slug ?? '']) }}" class="text-decoration-none fw-semibold" style="color: var(--primary-navy);">{{ $product->category->name ?? 'General' }}</a></p>

                <div class="d-flex align-items-center gap-3 mb-4 flex-wrap">
                    <div>
                        @if($product->has_discount)
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="badge bg-danger px-2 py-1 fs-6">-{{ $product->discount_percentage }}%</span>
                                <del class="text-muted fs-6">{{ $product->formatted_original_price }}</del>
                            </div>
                            <h3 class="fw-bold mb-0" style="color: #D00000;">{{ $product->formatted_price }}</h3>
                            <small class="text-success fw-semibold">
                                Hemat Rp{{ number_format($product->discount_amount, 0, ',', '.') }}
                            </small>
                        @else
                            <h3 class="fw-bold mb-0" style="color: var(--primary-navy);">{{ $product->formatted_price }}</h3>
                        @endif
                    </div>
                    <span class="badge {{ $product->stock_badge_class }} px-3 py-2 fs-6">{{ $product->stock_status }} (Stok: {{ $product->stock }})</span>
                </div>

                <hr class="my-4 border-secondary-subtle">

                <!-- DESKRIPSI -->
                <div class="mb-4">
                    <h6 class="fw-bold text-dark font-poppins mb-2">Deskripsi</h6>
                    <p class="text-secondary" style="line-height: 1.6; white-space: pre-line;">{{ $product->description ?: 'Tidak ada deskripsi tambahan.' }}</p>
                </div>

                <!-- SPESIFIKASI -->
                @if($product->specifications)
                    <div class="mb-4">
                        <h6 class="fw-bold text-dark font-poppins mb-2">Spesifikasi</h6>
                        <div class="text-secondary" style="line-height: 1.6; white-space: pre-line;">{{ $product->specifications }}</div>
                    </div>
                @endif

                <!-- MANFAAT -->
                @if($product->benefits)
                    <div class="mb-4">
                        <h6 class="fw-bold text-dark font-poppins mb-2">Manfaat</h6>
                        <div class="text-secondary" style="line-height: 1.6; white-space: pre-line;">{{ $product->benefits }}</div>
                    </div>
                @endif

                <!-- QUANTITY & ACTIONS -->
                @if($product->stock > 0)
                    <form action="{{ route('products.direct_wa', $product->id) }}" method="POST" target="_blank" class="mt-4" id="detailWaForm">
                        @csrf
                        <div class="d-flex align-items-center gap-3 mb-4">
                            <label class="fw-semibold text-dark">Jumlah:</label>
                            <div class="input-group" style="width: 140px;">
                                <button type="button" class="btn btn-outline-secondary" onclick="decrementQty()">-</button>
                                <input type="number" id="detailQty" name="quantity" class="form-control text-center fw-bold" value="1" min="1" max="{{ $product->stock }}">
                                <button type="button" class="btn btn-outline-secondary" onclick="incrementQty({{ $product->stock }})">+</button>
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <button type="button" class="btn btn-navy w-100 py-3 font-poppins fw-semibold shadow-sm" onclick="addToCartDetail()">
                                    <i class="bi bi-cart-plus fs-5 me-2"></i> Tambah ke Keranjang
                                </button>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-wa w-100 py-3 font-poppins fw-bold">
                                    <i class="bi bi-whatsapp fs-5 me-2"></i> Pesan Sekarang
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Add To Cart Hidden Form -->
                    <form action="{{ route('cart.add') }}" method="POST" id="hiddenCartForm">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="quantity" id="cartFormQty" value="1">
                    </form>
                @else
                    <div class="alert alert-danger py-3 mt-4" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i> Stok produk sedang habis. Silakan hubungi admin untuk informasi restock.
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- RELATED PRODUCTS -->
    @if($relatedProducts->count() > 0)
        <div class="mt-5">
            <h4 class="fw-bold text-dark font-poppins mb-4">Produk Serupa</h4>
            <div class="row g-4">
                @foreach($relatedProducts as $rel)
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="product-card">
                            <div class="product-img-wrapper">
                                @if($rel->image)
                                    <img src="{{ asset('storage/' . $rel->image) }}" alt="{{ $rel->name }}">
                                @else
                                    <img src="https://via.placeholder.com/400x350/F8FAFC/0B3B82?text=LC" alt="{{ $rel->name }}">
                                @endif
                            </div>
                            <div class="product-card-body">
                                <h6 class="product-title text-truncate">{{ $rel->name }}</h6>
                                <div class="product-price mb-2">{{ $rel->formatted_price }}</div>
                                <a href="{{ route('products.show', $rel->slug) }}" class="btn btn-outline-primary btn-sm w-100 mt-auto">Detail</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>

@push('scripts')
<script>
    function changeImage(src) {
        document.getElementById('mainProductImage').src = src;
    }

    function incrementQty(maxStock) {
        let input = document.getElementById('detailQty');
        let current = parseInt(input.value) || 1;
        if (current < maxStock) {
            input.value = current + 1;
        }
    }

    function decrementQty() {
        let input = document.getElementById('detailQty');
        let current = parseInt(input.value) || 1;
        if (current > 1) {
            input.value = current - 1;
        }
    }

    function addToCartDetail() {
        let qty = document.getElementById('detailQty').value;
        document.getElementById('cartFormQty').value = qty;
        document.getElementById('hiddenCartForm').submit();
    }
</script>
@endpush

@endsection
