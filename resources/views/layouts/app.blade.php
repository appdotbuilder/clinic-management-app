<!DOCTYPE html>
<html lang="id" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Sistem Manajemen Klinik')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
        }
        .navbar-brand {
            font-weight: 600;
            color: #1e40af !important;
        }
        .sidebar {
            min-height: calc(100vh - 56px);
            background-color: #ffffff;
            border-right: 1px solid #e5e7eb;
        }
        .sidebar .nav-link {
            color: #6b7280;
            border-radius: 0.5rem;
            margin-bottom: 0.25rem;
        }
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: #1e40af;
            background-color: #eff6ff;
        }
        .main-content {
            min-height: calc(100vh - 56px);
        }
        .card {
            border: none;
            box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1);
        }
        .btn-primary {
            background-color: #2563eb;
            border-color: #2563eb;
        }
        .btn-primary:hover {
            background-color: #1d4ed8;
            border-color: #1d4ed8;
        }
        .table th {
            background-color: #f9fafb;
            color: #374151;
            font-weight: 600;
        }
        .stats-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .stats-card.success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        }
        .stats-card.warning {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        }
        .stats-card.info {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        }
        .welcome-hero {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            min-height: 100vh;
        }
        .feature-card {
            transition: transform 0.2s;
        }
        .feature-card:hover {
            transform: translateY(-5px);
        }
        .theme-toggle {
            cursor: pointer;
        }
        [data-bs-theme="dark"] {
            --bs-body-bg: #1a1a1a;
            --bs-body-color: #e5e7eb;
        }
        [data-bs-theme="dark"] .sidebar {
            background-color: #2d2d2d;
            border-right-color: #404040;
        }
        [data-bs-theme="dark"] .navbar {
            background-color: #2d2d2d !important;
            border-bottom: 1px solid #404040;
        }
        [data-bs-theme="dark"] .card {
            background-color: #2d2d2d;
            border-color: #404040;
        }
        [data-bs-theme="dark"] .table th {
            background-color: #404040;
            color: #e5e7eb;
        }
    </style>

    @stack('styles')
</head>
<body>
    <div id="app">
        @auth
            <!-- Navigation -->
            <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
                <div class="container-fluid">
                    <a class="navbar-brand d-flex align-items-center" href="{{ route('dashboard') }}">
                        <span class="fs-4 me-2">🏥</span>
                        <span>Sistem Klinik</span>
                    </a>

                    <div class="navbar-nav ms-auto d-flex flex-row align-items-center">
                        <!-- Theme Toggle -->
                        <button class="btn btn-outline-secondary me-3 theme-toggle" onclick="toggleTheme()">
                            <i class="bi bi-sun-fill" id="theme-icon"></i>
                        </button>
                        
                        <!-- User Dropdown -->
                        <div class="dropdown">
                            <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle me-1"></i>
                                {{ Auth::user()->name }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><h6 class="dropdown-header">{{ ucfirst(Auth::user()->role) }}</h6></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i class="bi bi-box-arrow-right me-2"></i>Keluar
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>

            <div class="container-fluid">
                <div class="row">
                    <!-- Sidebar -->
                    <nav class="col-md-3 col-lg-2 d-md-block sidebar collapse">
                        <div class="position-sticky pt-3">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                                        <i class="bi bi-house-door me-2"></i>
                                        Dashboard
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('patients.*') ? 'active' : '' }}" href="{{ route('patients.index') }}">
                                        <i class="bi bi-people me-2"></i>
                                        Data Pasien
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('visits.*') ? 'active' : '' }}" href="{{ route('visits.index') }}">
                                        <i class="bi bi-clipboard-check me-2"></i>
                                        Kunjungan
                                    </a>
                                </li>
                                @if(Auth::user()->isAdmin())
                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        <i class="bi bi-gear me-2"></i>
                                        Pengaturan
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </nav>

                    <!-- Main content -->
                    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                                <i class="bi bi-check-circle me-2"></i>
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                                <i class="bi bi-exclamation-circle me-2"></i>
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @yield('content')
                    </main>
                </div>
            </div>
        @else
            @yield('content')
        @endauth
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Theme Toggle Script -->
    <script>
        function toggleTheme() {
            const html = document.documentElement;
            const currentTheme = html.getAttribute('data-bs-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            const themeIcon = document.getElementById('theme-icon');
            
            html.setAttribute('data-bs-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            
            if (newTheme === 'dark') {
                themeIcon.className = 'bi bi-moon-fill';
            } else {
                themeIcon.className = 'bi bi-sun-fill';
            }
        }
        
        // Load saved theme
        document.addEventListener('DOMContentLoaded', function() {
            const savedTheme = localStorage.getItem('theme') || 'light';
            const html = document.documentElement;
            const themeIcon = document.getElementById('theme-icon');
            
            html.setAttribute('data-bs-theme', savedTheme);
            
            if (savedTheme === 'dark' && themeIcon) {
                themeIcon.className = 'bi bi-moon-fill';
            }
        });
    </script>

    @stack('scripts')
</body>
</html>