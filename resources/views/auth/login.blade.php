<!DOCTYPE html>
<html lang="id" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk - Sistem Manajemen Klinik</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            color: white;
        }
        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .login-header {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
        }
        .form-control:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.25);
        }
        .btn-primary {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            border: none;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #1d4ed8 0%, #1e3a8a 100%);
        }
    </style>
</head>
<body class="d-flex align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <!-- Logo and Title -->
                <div class="text-center mb-4">
                    <div class="mb-3">
                        <span class="display-1">🏥</span>
                    </div>
                    <h1 class="h3 fw-bold">Sistem Manajemen Klinik</h1>
                    <p class="mb-0">Masuk ke akun Anda untuk melanjutkan</p>
                </div>

                <!-- Login Card -->
                <div class="card login-card shadow-lg">
                    <div class="card-header login-header text-white text-center py-4">
                        <h4 class="mb-0">
                            <i class="bi bi-box-arrow-in-right me-2"></i>
                            🔐 Masuk ke Sistem
                        </h4>
                    </div>
                    <div class="card-body p-4">
                        <!-- Status Message -->
                        @if ($status)
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="bi bi-check-circle me-2"></i>
                                {{ $status }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <!-- Email Address -->
                            <div class="mb-3">
                                <label for="email" class="form-label text-dark fw-medium">
                                    <i class="bi bi-envelope me-1"></i>
                                    Alamat Email
                                </label>
                                <input type="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       id="email" 
                                       name="email" 
                                       value="{{ old('email') }}" 
                                       placeholder="Masukkan email Anda"
                                       required 
                                       autofocus>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label text-dark fw-medium">
                                    <i class="bi bi-key me-1"></i>
                                    Kata Sandi
                                </label>
                                <div class="input-group">
                                    <input type="password" 
                                           class="form-control @error('password') is-invalid @enderror" 
                                           id="password" 
                                           name="password" 
                                           placeholder="Masukkan kata sandi"
                                           required>
                                    <button class="btn btn-outline-secondary" type="button" onclick="togglePassword()">
                                        <i class="bi bi-eye" id="toggleIcon"></i>
                                    </button>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Remember Me -->
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                <label class="form-check-label text-dark" for="remember">
                                    Ingat saya
                                </label>
                            </div>

                            <!-- Login Button -->
                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="bi bi-box-arrow-in-right me-2"></i>
                                    Masuk
                                </button>
                            </div>

                            <!-- Links -->
                            <div class="text-center">
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="text-decoration-none small">
                                        <i class="bi bi-question-circle me-1"></i>
                                        Lupa kata sandi?
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center bg-light">
                        <small class="text-muted">
                            <i class="bi bi-shield-check me-1"></i>
                            Login aman dengan enkripsi SSL
                        </small>
                    </div>
                </div>

                <!-- Back to Home -->
                <div class="text-center mt-4">
                    <a href="{{ route('home') }}" class="text-white text-decoration-none">
                        <i class="bi bi-arrow-left me-1"></i>
                        Kembali ke Beranda
                    </a>
                </div>

                <!-- Info Card -->
                <div class="card mt-4 bg-transparent border-light text-white">
                    <div class="card-body">
                        <h6 class="card-title">
                            <i class="bi bi-info-circle me-1"></i>
                            ℹ️ Informasi Login
                        </h6>
                        <ul class="list-unstyled small mb-0">
                            <li class="mb-1">
                                <i class="bi bi-check-circle text-success me-1"></i>
                                Gunakan akun yang telah terdaftar di sistem
                            </li>
                            <li class="mb-1">
                                <i class="bi bi-check-circle text-success me-1"></i>
                                Dashboard akan disesuaikan dengan role Anda
                            </li>
                            <li class="mb-1">
                                <i class="bi bi-check-circle text-success me-1"></i>
                                Sistem mendukung Admin, Dokter, dan Resepsionis
                            </li>
                            <li class="mb-0">
                                <i class="bi bi-shield-check text-warning me-1"></i>
                                Keamanan data terjamin dengan enkripsi tinggi
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.className = 'bi bi-eye-slash';
            } else {
                passwordInput.type = 'password';
                toggleIcon.className = 'bi bi-eye';
            }
        }

        // Auto-focus on email field
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('email').focus();
        });
    </script>
</body>
</html>