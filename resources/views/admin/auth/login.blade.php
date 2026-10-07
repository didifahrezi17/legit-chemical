<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - LEGIT CHEMICAL</title>

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="alternate icon" href="{{ asset('favicon.ico') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Custom Style Asset -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #F4F6F9;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
        }

        .login-card {
            width: 100%;
            max-width: 420px;
            background: #FFFFFF;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.06);
            padding: 2.5rem 2rem;
            border: 1px solid #E5E7EB;
        }

        .brand-header {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 2rem;
        }

        .btn-login {
            background-color: #0B3B82;
            color: #FFFFFF;
            font-weight: 600;
            padding: 0.75rem;
            border-radius: 8px;
            border: none;
            width: 100%;
            transition: background 0.2s ease;
        }

        .btn-login:hover {
            background-color: #1565C0;
            color: #FFFFFF;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="brand-header">
            <img src="{{ asset('images/logo.svg') }}" alt="LEGIT CHEMICAL Logo" height="46">
        </div>

        @if($errors->any())
            <div class="alert alert-danger py-2 small mb-3">
                <ul class="mb-0 ps-3">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="login" class="form-label small fw-semibold text-secondary">Email / Username</label>
                <div class="input-group">
                    <input type="text" name="login" id="login" class="form-control" placeholder="Masukkan email atau username" value="{{ old('login') }}" required autofocus>
                </div>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label small fw-semibold text-secondary">Password</label>
                <div class="input-group">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password" required>
                    <span class="input-group-text bg-white text-muted"><i class="bi bi-lock"></i></span>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label small text-secondary" for="remember">
                        Ingat saya
                    </label>
                </div>
            </div>

            <button type="submit" class="btn btn-login shadow-sm">
                Login
            </button>
        </form>

        <div class="text-center mt-4 small text-muted">
            © {{ date('Y') }} Legit Chemical. All Rights Reserved.
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Main JS Asset -->
    <script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
