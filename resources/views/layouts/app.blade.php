<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'LEGIT CHEMICAL - Solusi Kebutuhan Chemical & Industri')</title>

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="alternate icon" href="{{ asset('favicon.ico') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- Custom Style Asset -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
    :root {
        --primary-navy: #0B3B82;
        --primary-blue: #1565C0;
        --wa-green: #16C172;
        --wa-green-hover: #12A15E;
        --bg-light: #F5F7FA;
        --text-dark: #1E293B;
        --text-muted: #64748B;
    }

    body {
        font-family: 'Inter', 'Poppins', sans-serif;
        background-color: var(--bg-light);
        color: var(--text-dark);
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    .navbar-legit {
        background-color: #FFFFFF;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        padding: 0.85rem 0;
        position: sticky;
        top: 0;
        z-index: 1030;
    }

    .navbar-brand-legit {
        font-family: 'Poppins', sans-serif;
        font-weight: 700;
        font-size: 1.35rem;
        color: var(--primary-navy) !important;
        display: flex;
        align-items: center;
        gap: 8px;
        letter-spacing: 0.5px;
    }

    .navbar-nav .nav-link {
        font-weight: 500;
        color: #334155;
        padding: 0.5rem 1rem;
        transition: color 0.2s ease;
    }

    .navbar-nav .nav-link:hover,
    .navbar-nav .nav-link.active {
        color: var(--primary-navy);
        font-weight: 600;
    }

    .btn-navy {
        background-color: var(--primary-navy);
        color: #FFFFFF;
        border-radius: 8px;
        font-weight: 500;
        padding: 0.6rem 1.4rem;
        border: none;
        transition: all 0.2s ease;
    }

    .btn-navy:hover {
        background-color: var(--primary-blue);
        color: #FFFFFF;
        transform: translateY(-1px);
    }

    .btn-wa {
        background-color: var(--wa-green);
        color: #FFFFFF;
        border-radius: 8px;
        font-weight: 600;
        padding: 0.65rem 1.25rem;
        border: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .btn-wa:hover {
        background-color: var(--wa-green-hover);
        color: #FFFFFF;
        box-shadow: 0 4px 12px rgba(22, 193, 114, 0.3);
    }

    .cart-badge {
        background-color: var(--primary-navy);
        color: white;
        font-size: 0.75rem;
        border-radius: 50%;
        padding: 0.25rem 0.5rem;
        position: absolute;
        top: -6px;
        right: -8px;
        font-weight: 700;
    }

    .product-card {
        background: #FFFFFF;
        border-radius: 12px;
        border: 1px solid #E2E8F0;
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        transition: all 0.25s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
        overflow: hidden;
        position: relative;
        z-index: 1;
    }

    .product-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.07);
        border-color: #CBD5E1;
    }

    /* --- PERBAIKAN PADA RUMUS CSS GAMBAR & LINK --- */
    .product-img-wrapper {
        position: relative;
        width: 100%;
        padding-top: 85%; /* Aspek rasio wrapper */
        background-color: #F8FAFC;
        overflow: hidden;
    }

    .product-img-wrapper a {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: block;
        z-index: 5; /* Memastikan tautan berada di paling atas */
        cursor: pointer;
    }

    .product-img-wrapper a img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
        pointer-events: none; /* Mencegah elemen img memblokir klik pada <a> */
    }

    .product-card:hover .product-img-wrapper a img {
        transform: scale(1.04);
    }

    .product-card-body {
        padding: 1.25rem;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .product-category {
        font-size: 0.8rem;
        color: var(--text-muted);
        font-weight: 500;
        margin-bottom: 4px;
    }

    .product-title {
        font-size: 1.05rem;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 8px;
        line-height: 1.35;
    }

    .product-price {
        font-size: 1.15rem;
        font-weight: 700;
        color: var(--primary-navy);
        margin-bottom: 12px;
    }

    .footer-legit {
        background-color: #072552;
        color: #CBD5E1;
        padding: 3.5rem 0 1.5rem 0;
        margin-top: auto;
    }

    .footer-title {
        color: #FFFFFF;
        font-family: 'Poppins', sans-serif;
        font-weight: 600;
        margin-bottom: 1.25rem;
    }
 .hero-section { 
    position: relative; 
    min-height: 650px; 
    display: flex; 
    align-items: center; 
    overflow: hidden; 
    background: #edf4fb; 
} 

.hero-bg { 
    position: absolute; 
    inset: 0; 
    background-image: url('{{ asset('images/hero.png') }}'); 
    background-size: cover; 
    background-position: center; 
    background-repeat: no-repeat;
} 

.hero-overlay { 
    position: absolute; 
    inset: 0; 
    background: linear-gradient(
        90deg,
        rgba(237, 244, 251, 0.15) 0%,
        rgba(237, 244, 251, 0.05) 50%,
        rgba(237, 244, 251, 0) 100%
    );
} 

.hero-content { 
    position: relative; 
    z-index: 2; 
}
</style>
    @stack('styles')
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-legit">
        <div class="container">
            <a class="navbar-brand navbar-brand-legit p-0" href="{{ route('home') }}">
                <img src="{{ asset('images/logo.svg') }}" alt="LEGIT CHEMICAL Logo" height="42">
            </a>

            <div class="d-flex align-items-center gap-3 d-lg-none">
                <a href="{{ route('cart.index') }}" class="position-relative text-dark fs-5">
                    <i class="bi bi-cart3" style="color: var(--primary-navy);"></i>
                    @php $cartCount = array_sum(array_column(session('cart', []), 'quantity')); @endphp
                    <span class="badge cart-badge" id="mobile-cart-count">{{ $cartCount }}</span>
                </a>
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                    <i class="bi bi-list fs-2" style="color: var(--primary-navy);"></i>
                </button>
            </div>

            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}" href="{{ route('products.index') }}">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">Tentang Kami</a>
                    </li>
                </ul>

                <div class="d-flex align-items-center gap-3 ms-lg-3">
                    <!-- Search Form -->
                    <form action="{{ route('search') }}" method="GET" class="d-flex align-items-center me-2 position-relative" style="max-width: 220px;">
                        <input class="form-control form-control-sm pe-4 rounded-pill border-secondary-subtle" type="search" name="q" placeholder="Cari produk..." value="{{ request('q') }}">
                        <button class="btn btn-sm position-absolute end-0 me-1 border-0 text-muted" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </form>

                    <!-- Cart Icon with Badge -->
                    <a href="{{ route('cart.index') }}" class="position-relative text-dark fs-5 d-none d-lg-block p-1" title="Keranjang Belanja">
                        <i class="bi bi-cart3" style="color: var(--primary-navy); font-size: 1.35rem;"></i>
                        <span class="badge cart-badge" id="desktop-cart-count">{{ $cartCount }}</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- CONTENT -->
    <main class="flex-grow-1">
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="footer-legit">
        <div class="container">
            <div class="row g-4 mb-4">
                <div class="col-lg-4 col-md-6">
                    <div class="mb-3">
                        <img src="{{ asset('images/logo-white.svg') }}" alt="LEGIT CHEMICAL Logo" height="38">
                    </div>
                    <p class="small text-light-50">
                        Menyediakan berbagai kebutuhan bahan kimia, hardware, bahan & bibit, laundry, home care, car care, serta peralatan industri berkualitas dengan pelayanan profesional.
                    </p>
                </div>

                <div class="col-lg-4 col-md-6">
                    <h5 class="footer-title">Alamat & Kontak</h5>
                    <ul class="list-unstyled small text-light-50 mb-0">
                        <li class="mb-2"><i class="bi bi-geo-alt-fill me-2 text-primary"></i> Jl. Soekarno Hatta No. 123, Pekanbaru, Riau, Indonesia</li>
                        <li class="mb-2"><i class="bi bi-whatsapp me-2 text-success"></i> +{{ env('WHATSAPP_ADMIN', '6281234567890') }}</li>
                        <li class="mb-2"><i class="bi bi-envelope-fill me-2 text-primary"></i> info@legitchemical.com</li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-12">
                    <h5 class="footer-title">Ikuti Kami</h5>
                    <div class="d-flex gap-2">
                        <a href="https://www.facebook.com/legitchemical" class="btn btn-outline-light btn-sm rounded-circle" style="width: 36px; height: 36px;"><i class="bi bi-facebook"></i></a>
                        <a href="https://www.instagram.com/legitchemical" class="btn btn-outline-light btn-sm rounded-circle" style="width: 36px; height: 36px;"><i class="bi bi-instagram"></i></a>
                        <a href="https://wa.me/{{ env('WHATSAPP_ADMIN', '6281234567890') }}" class="btn btn-outline-light btn-sm rounded-circle" style="width: 36px; height: 36px;"><i class="bi bi-whatsapp"></i></a>
                        <a href="https://www.tiktok.com/@legitchemical" class="btn btn-outline-light btn-sm rounded-circle" style="width: 36px; height: 36px;"><i class="bi bi-tiktok"></i></a>
                    </div>
                </div>
            </div>

            <hr class="border-secondary my-4">

            <div class="text-center small text-secondary">
                © {{ date('Y') }} LEGIT CHEMICAL. All Rights Reserved.
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Main JS Asset -->
    <script src="{{ asset('js/main.js') }}"></script>

    <script>
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                timer: 3000,
                showConfirmButton: false
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: "{{ session('error') }}",
                confirmButtonColor: '#0B3B82'
            });
        @endif

        @if(session('info'))
            Swal.fire({
                icon: 'info',
                title: 'Informasi',
                text: "{{ session('info') }}",
                confirmButtonColor: '#0B3B82'
            });
        @endif
    </script>

    <!-- Floating WhatsApp Button -->
    <a href="https://wa.me/{{ env('WHATSAPP_ADMIN', '6281234567890') }}?text=Halo%20LEGIT%20CHEMICAL%2C%20saya%20ingin%20bertanya%20tentang%20produk"
       target="_blank"
       class="wa-float"
       title="Chat WhatsApp">
        <i class="bi bi-whatsapp"></i>
    </a>

    <style>
        .wa-float {
            position: fixed;
            bottom: 28px;
            right: 28px;
            z-index: 9999;
            width: 56px;
            height: 56px;
            background-color: #25D366;
            color: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.7rem;
            text-decoration: none;
            box-shadow: 0 4px 18px rgba(37, 211, 102, 0.45);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            animation: wa-pulse 2.2s infinite;
        }
        .wa-float:hover {
            transform: scale(1.12);
            box-shadow: 0 8px 28px rgba(37, 211, 102, 0.6);
            color: #fff;
        }
        @keyframes wa-pulse {
            0%   { box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.55); }
            70%  { box-shadow: 0 0 0 14px rgba(37, 211, 102, 0); }
            100% { box-shadow: 0 0 0 0 rgba(37, 211, 102, 0); }
        }
    </style>

    @stack('scripts')
</body>
</html>
