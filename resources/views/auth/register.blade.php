<!DOCTYPE html>
<html lang="id" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar - Sistem Manajemen Klinik</title>
    
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
        .register-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .register-header {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        }
        .form-control:focus {
            border-color: #10b981;
            box-shadow: 0 0 0 0.2rem rgba(16, 185, 129, 0.25);
        }
        .btn-success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            border: none;
        }
        .btn-success:hover {
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
        }
        .password-strength {
            height: 4px;
            border-radius: 2px;
            transition: all 0.3s ease;
        }
    </style>
</head>
<body class="d-flex align-items-center py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <!-- Logo and Title -->
                <div class="text-center mb-4">
                    <div class="mb-3">
                        <span class="display-1">🏥</span>
                    </div>
                    <h1 class="h3 fw-bold">Sistem Manajemen Klinik</h1>
                    <p class="mb-0">Buat akun baru untuk mengakses sistem</p>
                </div>

                <!-- Register Card -->
                <div class="card register-card shadow-lg">
                    <div class="card-header register-header text-white text-center py-4">
                        <h4 class="mb-0">
                            <i class="bi bi-person-plus me-2"></i>
                            📝 Daftar Akun Baru
                        </h4>
                    </div>
                    <div class="card-body p-4">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <!-- Name -->
                            <div class="mb-3">
                                <label for="name" class="form-label text-dark fw-medium">
                                    <i class="bi bi-person me-1"></i>
                                    Nama Lengkap <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name') }}" 
                                       placeholder="Masukkan nama lengkap Anda"
                                       required 
                                       autofocus>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email Address -->
                            <div class="mb-3">
                                <label for="email" class="form-label text-dark fw-medium">
                                    <i class="bi bi-envelope me-1"></i>
                                    Alamat Email <span class="text-danger">*</span>
                                </label>
                                <input type="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       id="email" 
                                       name="email" 
                                       value="{{ old('email') }}" 
                                       placeholder="contoh@email.com"
                                       required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">
                                    <i class="bi bi-info-circle me-1"></i>
                                    Email akan digunakan untuk login ke sistem
                                </div>
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label text-dark fw-medium">
                                    <i class="bi bi-key me-1"></i>
                                    Kata Sandi <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="password" 
                                           class="form-control @error('password') is-invalid @enderror" 
                                           id="password" 
                                           name="password" 
                                           placeholder="Minimal 8 karakter"
                                           required
                                           onkeyup="checkPasswordStrength()">
                                    <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password', 'toggleIcon1')">
                                        <i class="bi bi-eye" id="toggleIcon1"></i>
                                    </button>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mt-2">
                                    <div class="password-strength bg-light" id="passwordStrength"></div>
                                    <small class="text-muted" id="passwordStrengthText">Kekuatan kata sandi</small>
                                </div>
                            </div>

                            <!-- Confirm Password -->
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label text-dark fw-medium">
                                    <i class="bi bi-key-fill me-1"></i>
                                    Konfirmasi Kata Sandi <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="password" 
                                           class="form-control @error('password_confirmation') is-invalid @enderror" 
                                           id="password_confirmation" 
                                           name="password_confirmation" 
                                           placeholder="Ulangi kata sandi"
                                           required
                                           onkeyup="checkPasswordMatch()">
                                    <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password_confirmation', 'toggleIcon2')">
                                        <i class="bi bi-eye" id="toggleIcon2"></i>
                                    </button>
                                    @error('password_confirmation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mt-2">
                                    <small class="text-muted" id="passwordMatchText"></small>
                                </div>
                            </div>

                            <!-- Role Selection -->
                            <div class="mb-4">
                                <label for="role" class="form-label text-dark fw-medium">
                                    <i class="bi bi-person-badge me-1"></i>
                                    Role/Jabatan <span class="text-danger">*</span>
                                </label>
                                <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
                                    <option value="">Pilih role/jabatan...</option>
                                    <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>👨‍💼 Admin</option>
                                    <option value="doctor" {{ old('role') === 'doctor' ? 'selected' : '' }}>👨‍⚕️ Dokter</option>
                                    <option value="receptionist" {{ old('role') === 'receptionist' ? 'selected' : '' }}>👩‍💻 Resepsionis</option>
                                </select>
                                @error('role')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">
                                    <i class="bi bi-info-circle me-1"></i>
                                    Role menentukan akses dan fitur yang tersedia
                                </div>
                            </div>

                            <!-- Terms Agreement -->
                            <div class="mb-4 form-check">
                                <input type="checkbox" class="form-check-input" id="terms" required>
                                <label class="form-check-label text-dark small" for="terms">
                                    Saya setuju dengan <a href="#" class="text-decoration-none">syarat dan ketentuan</a> 
                                    serta <a href="#" class="text-decoration-none">kebijakan privasi</a> yang berlaku
                                </label>
                            </div>

                            <!-- Register Button -->
                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-success btn-lg" id="registerBtn" disabled>
                                    <i class="bi bi-person-plus me-2"></i>
                                    Daftar Sekarang
                                </button>
                            </div>

                            <!-- Login Link -->
                            <div class="text-center">
                                <small class="text-muted">
                                    Sudah punya akun? 
                                    <a href="{{ route('login') }}" class="text-decoration-none">
                                        <i class="bi bi-box-arrow-in-right me-1"></i>
                                        Masuk di sini
                                    </a>
                                </small>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center bg-light">
                        <small class="text-muted">
                            <i class="bi bi-shield-check me-1"></i>
                            Pendaftaran aman dengan enkripsi SSL
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

                <!-- Role Info Card -->
                <div class="card mt-4 bg-transparent border-light text-white">
                    <div class="card-body">
                        <h6 class="card-title">
                            <i class="bi bi-info-circle me-1"></i>
                            ℹ️ Informasi Role
                        </h6>
                        <div class="row g-2 small">
                            <div class="col-md-4">
                                <div class="p-2 bg-primary bg-opacity-25 rounded">
                                    <strong>👨‍💼 Admin</strong><br>
                                    Akses penuh ke semua fitur sistem
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="p-2 bg-success bg-opacity-25 rounded">
                                    <strong>👨‍⚕️ Dokter</strong><br>
                                    Akses data pasien dan kunjungan
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="p-2 bg-warning bg-opacity-25 rounded">
                                    <strong>👩‍💻 Resepsionis</strong><br>
                                    Pendaftaran dan pencatatan kunjungan
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        function togglePassword(inputId, iconId) {
            const passwordInput = document.getElementById(inputId);
            const toggleIcon = document.getElementById(iconId);
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.className = 'bi bi-eye-slash';
            } else {
                passwordInput.type = 'password';
                toggleIcon.className = 'bi bi-eye';
            }
        }

        function checkPasswordStrength() {
            const password = document.getElementById('password').value;
            const strengthBar = document.getElementById('passwordStrength');
            const strengthText = document.getElementById('passwordStrengthText');
            
            let strength = 0;
            let color = '';
            let text = '';
            
            if (password.length >= 8) strength++;
            if (password.match(/[a-z]/)) strength++;
            if (password.match(/[A-Z]/)) strength++;
            if (password.match(/[0-9]/)) strength++;
            if (password.match(/[^a-zA-Z0-9]/)) strength++;
            
            switch(strength) {
                case 0:
                case 1:
                    color = 'bg-danger';
                    text = 'Kata sandi lemah';
                    break;
                case 2:
                    color = 'bg-warning';
                    text = 'Kata sandi sedang';
                    break;
                case 3:
                    color = 'bg-info';
                    text = 'Kata sandi baik';
                    break;
                case 4:
                case 5:
                    color = 'bg-success';
                    text = 'Kata sandi kuat';
                    break;
            }
            
            strengthBar.className = `password-strength ${color}`;
            strengthBar.style.width = (strength * 20) + '%';
            strengthText.textContent = text;
            
            checkFormValidity();
        }

        function checkPasswordMatch() {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password_confirmation').value;
            const matchText = document.getElementById('passwordMatchText');
            
            if (confirmPassword.length > 0) {
                if (password === confirmPassword) {
                    matchText.textContent = '✓ Kata sandi cocok';
                    matchText.className = 'text-success small';
                } else {
                    matchText.textContent = '✗ Kata sandi tidak cocok';
                    matchText.className = 'text-danger small';
                }
            } else {
                matchText.textContent = '';
            }
            
            checkFormValidity();
        }

        function checkFormValidity() {
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password_confirmation').value;
            const role = document.getElementById('role').value;
            const terms = document.getElementById('terms').checked;
            const registerBtn = document.getElementById('registerBtn');
            
            const isValid = name && email && password.length >= 8 && password === confirmPassword && role && terms;
            
            registerBtn.disabled = !isValid;
        }

        // Add event listeners
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('name').addEventListener('keyup', checkFormValidity);
            document.getElementById('email').addEventListener('keyup', checkFormValidity);
            document.getElementById('role').addEventListener('change', checkFormValidity);
            document.getElementById('terms').addEventListener('change', checkFormValidity);
        });
    </script>
</body>
</html>