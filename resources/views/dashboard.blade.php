@extends('layouts.app')

@section('title', 'Dashboard - Sistem Manajemen Klinik')

@section('content')
<div class="py-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-900">
                <i class="bi bi-speedometer2 me-2"></i>
                Dashboard {{ ucfirst($user_role) }}
            </h1>
            <p class="text-muted mb-0">Selamat datang, {{ Auth::user()->name }}!</p>
        </div>
        <div class="text-muted">
            <i class="bi bi-calendar3 me-1"></i>
            {{ now()->format('l, d F Y') }}
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4 mb-4">
        @if($user_role === 'admin')
            <div class="col-xl-3 col-md-6">
                <div class="card stats-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <i class="bi bi-people display-4"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <div class="small fw-bold text-white-50 text-uppercase">Total Pasien</div>
                                <div class="display-6 fw-bold">{{ number_format($stats['total_patients']) }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card stats-card success">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <i class="bi bi-clipboard-check display-4"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <div class="small fw-bold text-white-50 text-uppercase">Total Kunjungan</div>
                                <div class="display-6 fw-bold">{{ number_format($stats['total_visits']) }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card stats-card warning">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <i class="bi bi-calendar-check display-4"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <div class="small fw-bold text-white-50 text-uppercase">Kunjungan Hari Ini</div>
                                <div class="display-6 fw-bold">{{ number_format($stats['visits_today']) }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card stats-card info">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <i class="bi bi-person-badge display-4"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <div class="small fw-bold text-white-50 text-uppercase">Total Dokter</div>
                                <div class="display-6 fw-bold">{{ number_format($stats['total_doctors']) }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @elseif($user_role === 'doctor')
            <div class="col-xl-3 col-md-6">
                <div class="card stats-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <i class="bi bi-people display-4"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <div class="small fw-bold text-white-50 text-uppercase">Total Pasien</div>
                                <div class="display-6 fw-bold">{{ number_format($stats['total_patients']) }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card stats-card success">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <i class="bi bi-calendar-check display-4"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <div class="small fw-bold text-white-50 text-uppercase">Kunjungan Hari Ini</div>
                                <div class="display-6 fw-bold">{{ number_format($stats['visits_today']) }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card stats-card warning">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <i class="bi bi-calendar-week display-4"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <div class="small fw-bold text-white-50 text-uppercase">Kunjungan Minggu Ini</div>
                                <div class="display-6 fw-bold">{{ number_format($stats['visits_this_week']) }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card stats-card info">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <i class="bi bi-clipboard-check display-4"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <div class="small fw-bold text-white-50 text-uppercase">Total Kunjungan</div>
                                <div class="display-6 fw-bold">{{ number_format($stats['total_visits']) }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <!-- Receptionist view -->
            <div class="col-xl-3 col-md-6">
                <div class="card stats-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <i class="bi bi-people display-4"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <div class="small fw-bold text-white-50 text-uppercase">Total Pasien</div>
                                <div class="display-6 fw-bold">{{ number_format($stats['total_patients']) }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card stats-card success">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <i class="bi bi-calendar-check display-4"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <div class="small fw-bold text-white-50 text-uppercase">Kunjungan Hari Ini</div>
                                <div class="display-6 fw-bold">{{ number_format($stats['visits_today']) }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card stats-card warning">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <i class="bi bi-person-plus display-4"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <div class="small fw-bold text-white-50 text-uppercase">Pasien Bulan Ini</div>
                                <div class="display-6 fw-bold">{{ number_format($stats['patients_this_month']) }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card stats-card info">
                    <div class="card-body text-center">
                        <div class="mb-2">
                            <i class="bi bi-clipboard-plus display-4"></i>
                        </div>
                        <div class="small fw-bold text-white-50 text-uppercase">Aksi Cepat</div>
                        <a href="{{ route('patients.create') }}" class="btn btn-light btn-sm mt-2">
                            <i class="bi bi-plus me-1"></i>Tambah Pasien
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Quick Actions -->
    <div class="row g-4 mb-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-lightning-charge me-2"></i>
                        Aksi Cepat
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2 d-md-block">
                        <a href="{{ route('patients.create') }}" class="btn btn-primary">
                            <i class="bi bi-person-plus me-1"></i>
                            Tambah Pasien Baru
                        </a>
                        <a href="{{ route('visits.create') }}" class="btn btn-success">
                            <i class="bi bi-clipboard-plus me-1"></i>
                            Catat Kunjungan
                        </a>
                        <a href="{{ route('patients.index') }}" class="btn btn-info">
                            <i class="bi bi-search me-1"></i>
                            Cari Pasien
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-info-circle me-2"></i>
                        Informasi Sistem
                    </h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2">
                            <i class="bi bi-check-circle text-success me-2"></i>
                            Sistem aktif dan berjalan normal
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-shield-check text-primary me-2"></i>
                            Keamanan data terjamin
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-clock text-info me-2"></i>
                            Backup otomatis setiap hari
                        </li>
                        <li class="mb-0">
                            <i class="bi bi-people text-warning me-2"></i>
                            Role: {{ ucfirst($user_role) }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Data -->
    <div class="row g-4">
        @if(isset($stats['recent_patients']) && count($stats['recent_patients']) > 0)
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-people me-2"></i>
                        Pasien Terbaru
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-sm mb-0">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Tanggal Daftar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($stats['recent_patients'] as $patient)
                                <tr>
                                    <td class="fw-medium">{{ $patient->nama }}</td>
                                    <td>{{ $patient->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <a href="{{ route('patients.show', $patient) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('patients.index') }}" class="btn btn-sm btn-outline-primary">
                        <i class="bi bi-arrow-right me-1"></i>
                        Lihat Semua Pasien
                    </a>
                </div>
            </div>
        </div>
        @endif

        @if(isset($stats['recent_visits']) && count($stats['recent_visits']) > 0)
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-clipboard-check me-2"></i>
                        Kunjungan Terbaru
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-sm mb-0">
                            <thead>
                                <tr>
                                    <th>Pasien</th>
                                    <th>Waktu Kunjungan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($stats['recent_visits'] as $visit)
                                <tr>
                                    <td class="fw-medium">{{ $visit->patient->nama }}</td>
                                    <td>{{ $visit->visited_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <a href="{{ route('visits.show', $visit) }}" class="btn btn-sm btn-outline-success">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('visits.index') }}" class="btn btn-sm btn-outline-success">
                        <i class="bi bi-arrow-right me-1"></i>
                        Lihat Semua Kunjungan
                    </a>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection