@extends('layouts.app')

@section('title', $patient->nama . ' - Detail Pasien')

@section('content')
<div class="py-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('patients.index') }}">Data Pasien</a>
                    </li>
                    <li class="breadcrumb-item active">{{ $patient->nama }}</li>
                </ol>
            </nav>
            <h1 class="h3 mb-0 text-gray-900">
                <i class="bi bi-person me-2"></i>
                Detail Pasien
            </h1>
        </div>
        <div>
            <a href="{{ route('patients.edit', $patient) }}" class="btn btn-warning me-2">
                <i class="bi bi-pencil me-1"></i>
                Edit Data
            </a>
            <a href="{{ route('patients.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i>
                Kembali
            </a>
        </div>
    </div>

    <div class="row g-4">
        <!-- Patient Information -->
        <div class="col-lg-8">
            <!-- Basic Info Card -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-person-badge me-2"></i>
                        Informasi Pasien
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Avatar and Name -->
                            <div class="d-flex align-items-center mb-4">
                                <div class="avatar-lg bg-primary text-white rounded-circle me-4 d-flex align-items-center justify-content-center">
                                    <span class="fs-2 fw-bold">{{ substr($patient->nama, 0, 1) }}</span>
                                </div>
                                <div>
                                    <h4 class="mb-1">{{ $patient->nama }}</h4>
                                    <p class="text-muted mb-0">
                                        @if($patient->tanggal_lahir)
                                            <i class="bi bi-calendar me-1"></i>
                                            {{ \Carbon\Carbon::parse($patient->tanggal_lahir)->format('d F Y') }}
                                            ({{ \Carbon\Carbon::parse($patient->tanggal_lahir)->age }} tahun)
                                        @else
                                            <i class="bi bi-calendar me-1"></i>
                                            Tanggal lahir tidak diisi
                                        @endif
                                    </p>
                                </div>
                            </div>

                            <!-- Contact Info -->
                            <div class="mb-3">
                                <h6 class="text-primary">Kontak</h6>
                                @if($patient->email)
                                <div class="d-flex align-items-center mb-2">
                                    <i class="bi bi-envelope me-2 text-muted"></i>
                                    <a href="mailto:{{ $patient->email }}" class="text-decoration-none">
                                        {{ $patient->email }}
                                    </a>
                                </div>
                                @endif
                                @if($patient->telepon)
                                <div class="d-flex align-items-center mb-2">
                                    <i class="bi bi-telephone me-2 text-muted"></i>
                                    <a href="tel:{{ $patient->telepon }}" class="text-decoration-none">
                                        {{ $patient->telepon }}
                                    </a>
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <!-- Address -->
                            @if($patient->alamat)
                            <div class="mb-3">
                                <h6 class="text-primary">Alamat</h6>
                                <div class="d-flex align-items-start">
                                    <i class="bi bi-geo-alt me-2 text-muted mt-1"></i>
                                    <div>{{ $patient->alamat }}</div>
                                </div>
                            </div>
                            @endif

                            <!-- Registration Info -->
                            <div class="mb-3">
                                <h6 class="text-primary">Informasi Registrasi</h6>
                                <div class="d-flex align-items-center mb-2">
                                    <i class="bi bi-calendar-plus me-2 text-muted"></i>
                                    <span>Terdaftar: {{ $patient->created_at->format('d F Y, H:i') }}</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-clock-history me-2 text-muted"></i>
                                    <span>{{ $patient->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Medical Information -->
            @if($patient->alergi || $patient->catatan)
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-heart-pulse me-2"></i>
                        Informasi Medis
                    </h5>
                </div>
                <div class="card-body">
                    @if($patient->alergi)
                    <div class="mb-3">
                        <h6 class="text-warning">
                            <i class="bi bi-exclamation-triangle me-1"></i>
                            Alergi
                        </h6>
                        <div class="alert alert-warning" role="alert">
                            <i class="bi bi-shield-exclamation me-2"></i>
                            {{ $patient->alergi }}
                        </div>
                    </div>
                    @endif

                    @if($patient->catatan)
                    <div class="mb-0">
                        <h6 class="text-info">
                            <i class="bi bi-note-text me-1"></i>
                            Catatan
                        </h6>
                        <div class="p-3 bg-light rounded">
                            {{ $patient->catatan }}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            @endif

            <!-- Visit History -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-clipboard-check me-2"></i>
                        Riwayat Kunjungan
                        <span class="badge bg-primary ms-2">{{ $patient->visits->count() }} kunjungan</span>
                    </h5>
                    <a href="{{ route('visits.create') }}?patient_id={{ $patient->id }}" class="btn btn-sm btn-success">
                        <i class="bi bi-plus me-1"></i>
                        Tambah Kunjungan
                    </a>
                </div>
                <div class="card-body">
                    @if($patient->visits->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Tanggal & Waktu</th>
                                        <th>Status</th>
                                        <th>Keterangan</th>
                                        <th width="100">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($patient->visits as $visit)
                                    <tr>
                                        <td>
                                            <div>{{ $visit->visited_at->format('d F Y') }}</div>
                                            <small class="text-muted">{{ $visit->visited_at->format('H:i') }}</small>
                                        </td>
                                        <td>
                                            <span class="badge bg-success">Selesai</span>
                                        </td>
                                        <td>
                                            <small class="text-muted">
                                                {{ $visit->visited_at->diffForHumans() }}
                                            </small>
                                        </td>
                                        <td>
                                            <a href="{{ route('visits.show', $visit) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <div class="mb-3">
                                <i class="bi bi-clipboard-x display-4 text-muted"></i>
                            </div>
                            <h6 class="text-muted">Belum ada kunjungan</h6>
                            <p class="text-muted small">Pasien ini belum pernah melakukan kunjungan.</p>
                            <a href="{{ route('visits.create') }}?patient_id={{ $patient->id }}" class="btn btn-success">
                                <i class="bi bi-plus me-1"></i>
                                Tambah Kunjungan Pertama
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Quick Actions -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-lightning-charge me-2"></i>
                        Aksi Cepat
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('visits.create') }}?patient_id={{ $patient->id }}" class="btn btn-success">
                            <i class="bi bi-clipboard-plus me-1"></i>
                            Catat Kunjungan Baru
                        </a>
                        <a href="{{ route('patients.edit', $patient) }}" class="btn btn-warning">
                            <i class="bi bi-pencil me-1"></i>
                            Edit Data Pasien
                        </a>
                        <a href="mailto:{{ $patient->email }}" class="btn btn-outline-primary {{ !$patient->email ? 'disabled' : '' }}">
                            <i class="bi bi-envelope me-1"></i>
                            Kirim Email
                        </a>
                        <a href="tel:{{ $patient->telepon }}" class="btn btn-outline-success {{ !$patient->telepon ? 'disabled' : '' }}">
                            <i class="bi bi-telephone me-1"></i>
                            Panggil
                        </a>
                    </div>
                </div>
            </div>

            <!-- Patient Stats -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-graph-up me-2"></i>
                        Statistik Pasien
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-3 text-center">
                        <div class="col-6">
                            <div class="bg-primary text-white p-3 rounded">
                                <div class="h4 mb-0">{{ $patient->visits->count() }}</div>
                                <small>Total Kunjungan</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="bg-success text-white p-3 rounded">
                                <div class="h4 mb-0">
                                    {{ $patient->visits->count() > 0 ? $patient->visits->first()->visited_at->diffInDays($patient->created_at) : 0 }}
                                </div>
                                <small>Hari Sejak Daftar</small>
                            </div>
                        </div>
                        @if($patient->visits->count() > 1)
                        <div class="col-12">
                            <div class="bg-info text-white p-3 rounded">
                                <div class="h6 mb-0">
                                    Kunjungan Terakhir:
                                </div>
                                <small>{{ $patient->visits->first()->visited_at->diffForHumans() }}</small>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Important Alerts -->
            @if($patient->alergi)
            <div class="card border-warning">
                <div class="card-header bg-warning text-dark">
                    <h6 class="card-title mb-0">
                        <i class="bi bi-exclamation-triangle me-1"></i>
                        ⚠️ Peringatan Alergi
                    </h6>
                </div>
                <div class="card-body">
                    <p class="card-text mb-0">{{ $patient->alergi }}</p>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

@push('styles')
<style>
    .avatar-lg {
        width: 80px;
        height: 80px;
        font-size: 2rem;
    }
</style>
@endpush
@endsection