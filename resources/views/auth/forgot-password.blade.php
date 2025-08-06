<!DOCTYPE html>
<html lang="id" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lupa Kata Sandi - Sistem Manajemen Klinik</title>
    
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
        .reset-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .reset-header {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        }
        .form-control:focus {
            border-color: #f59e0b;
            box-shadow: 0 0 0 0.2rem rgba(245, 158, 11, 0.25);
        }
        .btn-warning {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            border: none;
            color: white;
        }
        .btn-warning:hover {
            background: linear-gradient(135deg, #d97706 0%, #b45309 100%);
            color: white;
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
                    <p class="mb-0">Reset kata sandi Anda dengan mudah</p>
                </div>

                <!-- Reset Password Card -->
                <div class="card reset-card shadow-lg">
                    <div class="card-header reset-header text-white text-center py-4">
                        <h4 class="mb-0">
                            <i class="bi bi-key me-2"></i>
                            🔑 Lupa Kata Sandi
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

                        <!-- Instructions -->
                        <div class="alert alert-info" role="alert">
                            <i class="bi bi-info-circle me-2"></i>
                            <strong>Cara reset kata sandi:</strong><br>
                            Masukkan alamat email yang terdaftar di sistem. Kami akan mengirim link reset kata sandi ke email Anda.
                        </div>

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <!-- Email Address -->
                            <div class="mb-4">
                                <label for="email" class="form-label text-dark fw-medium">
                                    <i class="bi bi-envelope me-1"></i>
                                    Alamat Email <span class="text-danger">*</span>
                                </label>
                                <input type="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       id="email" 
                                       name="email" 
                                       value="{{ old('email') }}" 
                                       placeholder="Masukkan email yang terdaftar"
                                       required 
                                       autofocus>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">
                                    <i class="bi bi-shield-check me-1"></i>
                                    Pastikan email yang Anda masukkan benar dan aktif
                                </div>
                            </div>

                            <!-- Send Reset Link Button -->
                            <div class="d-grid mb-4">
                                <button type="submit" class="btn btn-warning btn-lg">
                                    <i class="bi bi-send me-2"></i>
                                    Kirim Link Reset
                                </button>
                            </div>

                            <!-- Back to Login -->
                            <div class="text-center">
                                <a href="{{ route('login') }}" class="text-decoration-none">
                                    <i class="bi bi-arrow-left me-1"></i>
                                    Kembali ke Login
                                </a>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center bg-light">
                        <small class="text-muted">
                            <i class="bi bi-clock me-1"></i>
                            Link reset akan kedaluwarsa dalam 60 menit
                        </small>
                    </div>
                </div>

                <!-- Back to Home -->
                <div class="text-center mt-4">
                    <a href="{{ route('home') }}" class="text-white text-decoration-none">
                        <i class="bi bi-house me-1"></i>
                        Kembali ke Beranda
                    </a>
                </div>

                <!-- Help Card -->
                <div class="card mt-4 bg-transparent border-light text-white">
                    <div class="card-body">
                        <h6 class="card-title">
                            <i class="bi bi-question-circle me-1"></i>
                            💡 Bantuan
                        </h6>
                        <ul class="list-unstyled small mb-0">
                            <li class="mb-1">
                                <i class="bi bi-check-circle text-success me-1"></i>
                                Pastikan email yang dimasukkan masih aktif dan dapat diakses
                            </li>
                            <li class="mb-1">
                                <i class="bi bi-check-circle text-success me-1"></i>
                                Periksa folder spam/junk jika email tidak masuk ke inbox
                            </li>
                            <li class="mb-1">
                                <i class="bi bi-check-circle text-success me-1"></i>
                                Link reset hanya berlaku selama 60 menit setelah dikirim
                            </li>
                            <li class="mb-0">
                                <i class="bi bi-info-circle text-info me-1"></i>
                                Hubungi administrator jika masih mengalami masalah
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
        // Auto-focus on email field
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('email').focus();
        });

        // Email validation
        document.getElementById('email').addEventListener('input', function(e) {
            const email = e.target.value;
            const submitBtn = document.querySelector('button[type="submit"]');
            
            if (email.includes('@') && email.includes('.')) {
                submitBtn.disabled = false;
            } else {
                submitBtn.disabled = email.length === 0 ? false : true;
            }
        });
    </script>
</body>
</html>