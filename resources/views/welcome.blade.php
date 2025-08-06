<!DOCTYPE html>
<html lang="id" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Manajemen Klinik</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            color: white;
        }
        .feature-card {
            transition: transform 0.3s ease;
            border: none;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
        }
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1);
        }
        .feature-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }
        .stats-number {
            font-size: 2.5rem;
            font-weight: bold;
            color: #1e40af;
        }
        .btn-primary-custom {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            border: none;
            padding: 12px 30px;
            font-weight: 600;
            border-radius: 8px;
        }
        .btn-primary-custom:hover {
            background: linear-gradient(135deg, #1d4ed8 0%, #1e3a8a 100%);
            transform: translateY(-1px);
        }
        .navbar-custom {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="/">
                <span class="fs-4 me-2">🏥</span>
                Sistem Klinik
            </a>
            
            <div class="navbar-nav ms-auto">
                @auth
                    <a href="{{ route('dashboard') }}" class="btn btn-primary me-2">
                        <i class="bi bi-speedometer2 me-1"></i>
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">
                        <i class="bi bi-box-arrow-in-right me-1"></i>
                        Masuk
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section d-flex align-items-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="text-center text-lg-start">
                        <div class="display-1 mb-4">🏥</div>
                        <h1 class="display-4 fw-bold mb-4">
                            Sistem Manajemen Klinik Modern
                        </h1>
                        <p class="lead mb-5">
                            Kelola data pasien, kunjungan, dan administrasi klinik dengan mudah dan efisien. 
                            Interface dalam Bahasa Indonesia dengan fitur lengkap untuk kebutuhan klinik Anda.
                        </p>
                        
                        @guest
                        <div class="d-grid gap-3 d-md-flex justify-content-md-start">
                            <a href="{{ route('login') }}" class="btn btn-light btn-lg px-5">
                                <i class="bi bi-box-arrow-in-right me-2"></i>
                                🔐 Masuk ke Sistem
                            </a>
                        </div>
                        @else
                        <div class="d-grid gap-3 d-md-flex justify-content-md-start">
                            <a href="{{ route('dashboard') }}" class="btn btn-light btn-lg px-5">
                                <i class="bi bi-speedometer2 me-2"></i>
                                📊 Buka Dashboard
                            </a>
                            <a href="{{ route('patients.index') }}" class="btn btn-outline-light btn-lg px-5">
                                <i class="bi bi-people me-2"></i>
                                👥 Data Pasien
                            </a>
                        </div>
                        @endguest
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="card border-0 shadow-lg">
                        <div class="card-body p-4">
                            <h4 class="card-title text-dark mb-4">
                                <i class="bi bi-star-fill text-warning me-2"></i>
                                ✨ Fitur Unggulan
                            </h4>
                            <div class="row g-3 text-dark">
                                <div class="col-12">
                                    <div class="d-flex align-items-center">
                                        <span class="badge bg-success rounded-pill me-3">✓</span>
                                        <span>Data pasien lengkap dengan alergi dan catatan medis</span>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-flex align-items-center">
                                        <span class="badge bg-success rounded-pill me-3">✓</span>
                                        <span>Pencatatan kunjungan pasien real-time</span>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-flex align-items-center">
                                        <span class="badge bg-success rounded-pill me-3">✓</span>
                                        <span>Dashboard khusus untuk setiap role (Admin/Dokter/Resepsionis)</span>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-flex align-items-center">
                                        <span class="badge bg-success rounded-pill me-3">✓</span>
                                        <span>Interface dalam Bahasa Indonesia</span>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-flex align-items-center">
                                        <span class="badge bg-success rounded-pill me-3">✓</span>
                                        <span>Keamanan login terintegrasi</span>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-flex align-items-center">
                                        <span class="badge bg-success rounded-pill me-3">✓</span>
                                        <span>Responsive design untuk semua perangkat</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="alert alert-info mt-4" role="alert">
                                <i class="bi bi-lightbulb me-2"></i>
                                <strong>💡 Tips:</strong> Sistem ini dirancang khusus untuk memudahkan pengelolaan klinik dengan workflow yang efisien dan modern.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold text-dark">🌟 Fitur Lengkap untuk Klinik Modern</h2>
                <p class="lead text-muted">Semua yang Anda butuhkan untuk mengelola klinik dengan efisien</p>
            </div>
            
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card feature-card h-100 text-center">
                        <div class="card-body p-4">
                            <div class="feature-icon">👥</div>
                            <h4 class="card-title text-primary">Manajemen Pasien</h4>
                            <p class="card-text">
                                Kelola data lengkap pasien termasuk informasi kontak, alergi, 
                                dan catatan medis penting. Pencarian dan filter data yang mudah.
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card feature-card h-100 text-center">
                        <div class="card-body p-4">
                            <div class="feature-icon">📋</div>
                            <h4 class="card-title text-success">Pencatatan Kunjungan</h4>
                            <p class="card-text">
                                Rekam setiap kunjungan pasien dengan timestamp otomatis. 
                                Histori kunjungan lengkap untuk analisis dan pelaporan.
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card feature-card h-100 text-center">
                        <div class="card-body p-4">
                            <div class="feature-icon">👨‍⚕️</div>
                            <h4 class="card-title text-info">Multi-Role Access</h4>
                            <p class="card-text">
                                Sistem role berbeda untuk Admin, Dokter, dan Resepsionis 
                                dengan akses sesuai kebutuhan masing-masing.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    @auth
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h3 class="fw-bold text-dark">📊 Statistik Singkat</h3>
            </div>
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="card text-center border-0 bg-primary text-white">
                        <div class="card-body">
                            <div class="stats-number text-white">{{ \App\Models\Patient::count() }}</div>
                            <div>Total Pasien</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center border-0 bg-success text-white">
                        <div class="card-body">
                            <div class="stats-number text-white">{{ \App\Models\PatientVisit::count() }}</div>
                            <div>Total Kunjungan</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center border-0 bg-info text-white">
                        <div class="card-body">
                            <div class="stats-number text-white">{{ \App\Models\PatientVisit::whereDate('visited_at', today())->count() }}</div>
                            <div>Kunjungan Hari Ini</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center border-0 bg-warning text-white">
                        <div class="card-body">
                            <div class="stats-number text-white">{{ \App\Models\User::count() }}</div>
                            <div>Total Pengguna</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endauth

    <!-- Footer -->
    <footer class="bg-dark text-light py-4">
        <div class="container text-center">
            <p class="mb-0">
                <i class="bi bi-heart-fill text-danger me-1"></i>
                Dibuat dengan 💙 untuk kemudahan pengelolaan klinik modern
            </p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>