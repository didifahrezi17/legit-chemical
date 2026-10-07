@extends('layouts.app')

@section('title', 'Keranjang Belanja - LEGIT CHEMICAL')

@section('content')
<div class="container py-4">
    <h3 class="fw-bold text-dark font-poppins mb-4">Keranjang Belanja</h3>

    @if(!empty($cart) && count($cart) > 0)
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm p-3 mb-3" style="border-radius: 12px; background: #FFFFFF;">
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" style="width: 80px;">Foto</th>
                                    <th scope="col">Produk</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col" style="width: 140px;">Jumlah</th>
                                    <th scope="col">Subtotal</th>
                                    <th scope="col" class="text-center" style="width: 60px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cart as $id => $item)
                                    <tr>
                                        <td>
                                            <div class="rounded bg-light p-1 text-center" style="width: 60px; height: 60px;">
                                                @if($item['image'])
                                                    <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" class="img-fluid h-100 object-fit-cover rounded">
                                                @else
                                                    <img src="https://via.placeholder.com/60/F8FAFC/0B3B82?text=LC" alt="{{ $item['name'] }}" class="img-fluid h-100 object-fit-cover rounded">
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <a href="{{ route('products.show', $item['slug']) }}" class="text-decoration-none fw-semibold text-dark">
                                                {{ $item['name'] }}
                                            </a>
                                            <br>
                                            <span class="text-muted small">{{ $item['category_name'] }}</span>
                                        </td>
                                        <td class="fw-medium">
                                            Rp{{ number_format($item['price'], 0, ',', '.') }}
                                        </td>
                                        <td>
                                            <form action="{{ route('cart.update') }}" method="POST" class="d-flex align-items-center">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $id }}">
                                                <div class="input-group input-group-sm">
                                                    <button type="submit" name="quantity" value="{{ max(1, $item['quantity'] - 1) }}" class="btn btn-outline-secondary">-</button>
                                                    <input type="text" class="form-control text-center px-1 fw-bold" value="{{ $item['quantity'] }}" readonly>
                                                    <button type="submit" name="quantity" value="{{ min($item['stock'], $item['quantity'] + 1) }}" class="btn btn-outline-secondary">+</button>
                                                </div>
                                            </form>
                                        </td>
                                        <td class="fw-bold" style="color: var(--primary-navy);">
                                            Rp{{ number_format($item['subtotal'], 0, ',', '.') }}
                                        </td>
                                        <td class="text-center">
                                            <form action="{{ route('cart.remove') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $id }}">
                                                <button type="submit" class="btn btn-outline-danger btn-sm rounded-circle" title="Hapus">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-3 pt-3 border-top">
                        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-arrow-left me-1"></i> Lanjut Belanja
                        </a>
                        <form action="{{ route('cart.clear') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-light btn-sm text-danger border-0">
                                <i class="bi bi-trash me-1"></i> Kosongkan Keranjang
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- CART SUMMARY & WHATSAPP CONSULTATION -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm p-4" style="border-radius: 12px; background: #FFFFFF;">
                    <h5 class="fw-bold text-dark font-poppins mb-3">Ringkasan Konsultasi</h5>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Total Estimasi</span>
                        <span class="fs-4 fw-bold" style="color: var(--primary-navy);">Rp{{ number_format($totalEstimate, 0, ',', '.') }}</span>
                    </div>

                    <div class="alert alert-info py-2 small mb-4">
                        <i class="bi bi-info-circle me-1"></i> Klik tombol di bawah untuk membuat daftar produk dan berkonsultasi langsung dengan Admin via WhatsApp.
                    </div>

                    <form action="{{ route('cart.checkout') }}" method="POST" target="_blank">
                        @csrf
                        <button type="submit" class="btn btn-wa w-100 py-3 font-poppins fw-bold shadow-sm">
                            <i class="bi bi-whatsapp fs-5 me-2"></i> Konsultasi via WhatsApp
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @else
        <!-- EMPTY STATE -->
        <div class="card border-0 shadow-sm text-center py-5 px-4" style="border-radius: 16px; background: #FFFFFF;">
            <div class="mb-3">
                <img src="{{ asset('images/empty-cart.svg') }}" alt="Keranjang Kosong" style="max-height: 160px; width: auto;">
            </div>
            <h4 class="fw-bold text-dark font-poppins">Keranjang Anda Masih Kosong</h4>
            <p class="text-muted mb-4">Anda belum menambahkan produk apapun ke dalam keranjang konsultasi.</p>
            <div>
                <a href="{{ route('products.index') }}" class="btn btn-navy px-4 py-2 font-poppins fw-semibold shadow-sm">
                    <i class="bi bi-grid-fill me-2"></i> Jelajahi Produk Sekarang
                </a>
            </div>
        </div>
    @endif
</div>
@endsection
