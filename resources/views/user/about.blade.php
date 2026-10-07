@extends('layouts.app')

@section('title', 'Tentang Kami - LEGIT CHEMICAL')

@section('content')
<div class="container py-5">
    <div class="row align-items-center g-5 mb-5">
        <div class="col-lg-6">
            <h6 class="text-primary font-poppins fw-bold text-uppercase tracking-wider">Profil Perusahaan</h6>
            <h2 class="fw-bold text-dark mb-3 display-6" style="font-family: 'Poppins', sans-serif;">LEGIT CHEMICAL</h2>
            <p class="text-secondary fs-5" style="line-height: 1.7;">
                LEGIT CHEMICAL adalah penyedia terpercaya untuk kebutuhan bahan kimia industri, perlengkapan hardware, bahan &amp; bibit unggul, formula laundry, produk pembersih rumah tangga (home care), perawatan kendaraan (car care), dan perlengkapan perkakas industri di Indonesia.
            </p>
            <p class="text-secondary mb-4" style="line-height: 1.7;">
                Kami berkomitmen memberikan produk dengan kualitas standar tertinggi, harga kompetitif, serta layanan konsultasi teknis yang cepat dan responsif bagi pelanggan individu maupun korporasi.
            </p>
            <div class="d-flex gap-3">
                <a href="{{ route('products.index') }}" class="btn btn-navy px-4 py-2">
                    <i class="bi bi-grid-fill me-2"></i> Jelajahi Produk
                </a>
                <a href="{{ route('contact') }}" class="btn btn-outline-primary px-4 py-2" style="border-radius: 8px; border-color: var(--primary-navy); color: var(--primary-navy);">
                    Kontak Kami
                </a>
            </div>
        </div>
        <div class="col-lg-6 text-center">
            <img src="{{ asset('images/produk.jpeg') }}" alt="Tentang LEGIT CHEMICAL" class="img-fluid rounded-4 shadow-sm" style="max-height: 360px; width: 100%; object-fit: contain;">
        </div>
    </div>

    <!-- VISI & MISI -->
    <div class="row g-4 mb-5">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm p-4 h-100" style="border-radius: 12px; background: #FFFFFF;">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center text-white" style="width: 50px; height: 50px; background-color: var(--primary-navy);">
                        <i class="bi bi-eye fs-4"></i>
                    </div>
                    <h4 class="fw-bold text-dark font-poppins mb-0">Visi Kami</h4>
                </div>
                <p class="text-secondary mb-0" style="line-height: 1.6;">
                    Menjadi mitra penyedia bahan kimia dan peralatan industri terdepan di Indonesia yang dikenal atas integritas, inovasi produk, dan kepuasan pelanggan utama.
                </p>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-0 shadow-sm p-4 h-100" style="border-radius: 12px; background: #FFFFFF;">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center text-white" style="width: 50px; height: 50px; background-color: var(--primary-blue);">
                        <i class="bi bi-bullseye fs-4"></i>
                    </div>
                    <h4 class="fw-bold text-dark font-poppins mb-0">Misi Kami</h4>
                </div>
                <p class="text-secondary mb-0" style="line-height: 1.6;">
                    Menyediakan varian produk kimia dan perlengkapan lengkap, memberikan konsultasi gratis yang akurat, serta menjalin hubungan jangka panjang yang saling menguntungkan dengan setiap pelanggan.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
