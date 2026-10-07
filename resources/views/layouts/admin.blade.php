<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard - LEGIT CHEMICAL')</title>

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
            --admin-navy: #0B3B82;
            --admin-navy-dark: #072552;
            --admin-accent: #1565C0;
            --bg-admin: #F4F6F9;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-admin);
            min-height: 100vh;
        }

        .sidebar-admin {
            width: 260px;
            background-color: var(--admin-navy);
            color: #FFFFFF;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 1000;
            transition: all 0.3s ease;
            box-shadow: 4px 0 15px rgba(0,0,0,0.05);
            display: flex;
            flex-direction: column;
        }

        .sidebar-brand {
            padding: 1.25rem 1.5rem;
            background-color: var(--admin-navy-dark);
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: 1.15rem;
            display: flex;
            align-items: center;
            gap: 10px;
            letter-spacing: 0.5px;
            color: #FFFFFF;
            text-decoration: none;
        }

        .sidebar-menu {
            padding: 1.5rem 0.75rem;
            list-style: none;
            margin: 0;
            flex-grow: 1;
        }

        .sidebar-item {
            margin-bottom: 0.35rem;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0.75rem 1rem;
            color: #D1D5DB;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .sidebar-link:hover,
        .sidebar-link.active {
            background-color: var(--admin-accent);
            color: #FFFFFF;
        }

        .main-wrapper {
            margin-left: 260px;
            padding: 1.5rem 2rem;
            transition: all 0.3s ease;
        }

        .admin-topbar {
            background: #FFFFFF;
            border-radius: 12px;
            padding: 1rem 1.5rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.03);
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .card-stat {
            background: #FFFFFF;
            border-radius: 12px;
            padding: 1.5rem;
            border: 1px solid #E5E7EB;
            box-shadow: 0 2px 8px rgba(0,0,0,0.02);
            display: flex;
            align-items: center;
            gap: 1.25rem;
        }

        .stat-icon {
            width: 54px;
            height: 54px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        @media (max-width: 991.98px) {
            .sidebar-admin {
                margin-left: -260px;
            }
            .sidebar-admin.show {
                margin-left: 0;
            }
            .main-wrapper {
                margin-left: 0;
            }
        }
    </style>

    @stack('styles')
</head>
<body>

    <!-- SIDEBAR -->
    <aside class="sidebar-admin" id="adminSidebar">
        <a href="{{ route('admin.dashboard') }}" class="sidebar-brand py-3">
            <img src="{{ asset('images/logo-white.svg') }}" alt="LEGIT CHEMICAL Logo" height="34">
        </a>

        <ul class="sidebar-menu">
            <li class="sidebar-item">
                <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2 fs-5"></i> Dashboard
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('admin.produk.index') }}" class="sidebar-link {{ request()->routeIs('admin.produk.*') ? 'active' : '' }}">
                    <i class="bi bi-box-seam fs-5"></i> Produk
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('admin.pesanan.index') }}" class="sidebar-link {{ request()->routeIs('admin.pesanan.*') ? 'active' : '' }}">
                    <i class="bi bi-cart-check fs-5"></i> Pesanan / Konsultasi
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('admin.riwayat_pesanan.index') }}" class="sidebar-link {{ request()->routeIs('admin.riwayat_pesanan.*') ? 'active' : '' }}">
                    <i class="bi bi-receipt fs-5"></i> Riwayat Pesanan
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('admin.profile.edit') }}" class="sidebar-link {{ request()->routeIs('admin.profile.*') ? 'active' : '' }}">
                    <i class="bi bi-person-circle fs-5"></i> Profil
                </a>
            </li>
            <li class="sidebar-item mt-4">
                <form action="{{ route('admin.logout') }}" method="POST" id="logoutForm">
                    @csrf
                    <button type="submit" class="sidebar-link w-100 text-start border-0 bg-transparent text-danger">
                        <i class="bi bi-box-arrow-right fs-5"></i> Logout
                    </button>
                </form>
            </li>
        </ul>
    </aside>

    <!-- MAIN CONTENT WRAPPER -->
    <div class="main-wrapper">
        <!-- TOPBAR -->
        <header class="admin-topbar">
            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-light d-lg-none" type="button" id="sidebarToggle">
                    <i class="bi bi-list fs-4"></i>
                </button>
                <h4 class="mb-0 font-poppins fw-bold" style="color: var(--admin-navy);">@yield('page_title', 'Dashboard')</h4>
            </div>

            <div class="d-flex align-items-center gap-3">
                <span class="text-muted small d-none d-md-inline"><i class="bi bi-calendar3 me-1"></i> {{ date('l, d F Y') }}</span>
                <div class="dropdown">
                    <button class="btn btn-outline-secondary btn-sm dropdown-toggle d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown">
                        <i class="bi bi-person-circle fs-5 text-primary"></i>
                        <span>{{ Auth::guard('admin')->user()->name ?? 'Admin' }}</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                        <li><a class="dropdown-item" href="{{ route('admin.profile.edit') }}"><i class="bi bi-person me-2"></i> Edit Profil</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('admin.logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger"><i class="bi bi-box-arrow-right me-2"></i> Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </header>

        <!-- MAIN BODY CONTENT -->
        @yield('content')
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Main JS Asset -->
    <script src="{{ asset('js/main.js') }}"></script>

    <script>
        document.getElementById('sidebarToggle')?.addEventListener('click', function() {
            document.getElementById('adminSidebar')?.classList.toggle('show');
        });

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

        // SweetAlert2 Confirmation for Delete actions
        function confirmDelete(formId, message = 'Apakah Anda yakin ingin menghapus data ini?') {
            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: message,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#DC2626',
                cancelButtonColor: '#64748B',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(formId).submit();
                }
            });
        }
    </script>

    @stack('scripts')
</body>
</html>
