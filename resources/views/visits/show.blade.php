@extends('layouts.app')

@section('title', 'Detail Kunjungan - ' . $visit->patient->nama)

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
                        <a href="{{ route('visits.index') }}">Data Kunjungan</a>
                    </li>
                    <li class="breadcrumb-item active">Detail Kunjungan</li>
                </ol>
            </nav>
            <h1 class="h3 mb-0 text-gray-900">
                <i class="bi bi-clipboard-check me-2"></i>
                Detail Kunjungan
            </h1>
        </div>
        <div>
            <a href="{{ route('visits.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i>
                Kembali
            </a>
        </div>
    </div>

    <div class="row g-4">
        <!-- Visit Information -->
        <div class="col-lg-8">
            <!-- Visit Details Card -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-clipboard-data me-2"></i>
                        Informasi Kunjungan
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <h6 class="text-primary mb-2">
                                    <i class="bi bi-calendar-check me-1"></i>
                                    Tanggal & Waktu
                                </h6>
                                <div class="d-flex align-items-center mb-2">
                                    <i class="bi bi-calendar3 me-2 text-muted"></i>
                                    <span class="fw-bold">{{ $visit->visited_at->format('l, d F Y') }}</span>
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <i class="bi bi-clock me-2 text-muted"></i>
                                    <span>{{ $visit->visited_at->format('H:i') }} WIB</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-hourglass-split me-2 text-muted"></i>
                                    <span class="text-muted">{{ $visit->visited_at->diffForHumans() }}</span>
                                </div>
                            </div>

                            <div class="mb-3">
                                <h6 class="text-primary mb-2">
                                    <i class="bi bi-check-circle me-1"></i>
                                    Status Kunjungan
                                </h6>
                                <span class="badge bg-success fs-6">
                                    <i class="bi bi-check-circle me-1"></i>
                                    Selesai
                                </span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <h6 class="text-primary mb-2">
                                    <i class="bi bi-info-circle me-1"></i>
                                    Informasi Sistem
                                </h6>
                                <div class="small text-muted">
                                    <div class="mb-1">
                                        <strong>ID Kunjungan:</strong> #{{ $visit->id }}
                                    </div>
                                    <div class="mb-1">
                                        <strong>Dicatat pada:</strong> {{ $visit->created_at->format('d F Y, H:i') }}
                                    </div>
                                    @if($visit->created_at != $visit->updated_at)
                                    <div class="mb-1">
                                        <strong>Terakhir diperbarui:</strong> {{ $visit->updated_at->format('d F Y, H:i') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Patient Information Card -->
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
                            <!-- Patient Avatar and Basic Info -->
                            <div class="d-flex align-items-center mb-4">
                                <div class="avatar-lg bg-primary text-white rounded-circle me-4 d-flex align-items-center justify-content-center">
                                    <span class="fs-2 fw-bold">{{ substr($visit->patient->nama, 0, 1) }}</span>
                                </div>
                                <div>
                                    <h4 class="mb-1">
                                        <a href="{{ route('patients.show', $visit->patient) }}" class="text-decoration-none">
                                            {{ $visit->patient->nama }}
                                        </a>
                                    </h4>
                                    @if($visit->patient->tanggal_lahir)
                                    <p class="text-muted mb-0">
                                        <i class="bi bi-calendar me-1"></i>
                                        {{ \Carbon\Carbon::parse($visit->patient->tanggal_lahir)->format('d F Y') }}
                                        ({{ \Carbon\Carbon::parse($visit->patient->tanggal_lahir)->age }} tahun)
                                    </p>
                                    @endif
                                </div>
                            </div>

                            <!-- Contact Info -->
                            <div class="mb-3">
                                <h6 class="text-secondary">Kontak</h6>
                                @if($visit->patient->email)
                                <div class="d-flex align-items-center mb-2">
                                    <i class="bi bi-envelope me-2 text-muted"></i>
                                    <a href="mailto:{{ $visit->patient->email }}" class="text-decoration-none">
                                        {{ $visit->patient->email }}
                                    </a>
                                </div>
                                @endif
                                @if($visit->patient->telepon)
                                <div class="d-flex align-items-center mb-2">
                                    <i class="bi bi-telephone me-2 text-muted"></i>
                                    <a href="tel:{{ $visit->patient->telepon }}" class="text-decoration-none">
                                        {{ $visit->patient->telepon }}
                                    </a>
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <!-- Address -->
                            @if($visit->patient->alamat)
                            <div class="mb-3">
                                <h6 class="text-secondary">Alamat</h6>
                                <div class="d-flex align-items-start">
                                    <i class="bi bi-geo-alt me-2 text-muted mt-1"></i>
                                    <div>{{ $visit->patient->alamat }}</div>
                                </div>
                            </div>
                            @endif

                            <!-- Visit History -->
                            <div class="mb-3">
                                <h6 class="text-secondary">Histori Kunjungan</h6>
                                <div class="d-flex align-items-center mb-1">
                                    <i class="bi bi-clipboard-check me-2 text-muted"></i>
                                    <span>Total kunjungan: <strong>{{ $visit->patient->visits->count() }}</strong></span>
                                </div>
                                @if($visit->patient->visits->count() > 1)
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-clock-history me-2 text-muted"></i>
                                    <span>Kunjungan sebelumnya: 
                                        @php
                                            $previousVisit = $visit->patient->visits->where('id', '!=', $visit->id)->first();
                                        @endphp
                                        @if($previousVisit)
                                            {{ $previousVisit->visited_at->format('d/m/Y') }}
                                        @else
                                            Tidak ada
                                        @endif
                                    </span>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Medical Information -->
            @if($visit->patient->alergi || $visit->patient->catatan)
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-heart-pulse me-2"></i>
                        Informasi Medis Pasien
                    </h5>
                </div>
                <div class="card-body">
                    @if($visit->patient->alergi)
                    <div class="mb-3">
                        <h6 class="text-warning">
                            <i class="bi bi-exclamation-triangle me-1"></i>
                            Alergi
                        </h6>
                        <div class="alert alert-warning" role="alert">
                            <i class="bi bi-shield-exclamation me-2"></i>
                            {{ $visit->patient->alergi }}
                        </div>
                    </div>
                    @endif

                    @if($visit->patient->catatan)
                    <div class="mb-0">
                        <h6 class="text-info">
                            <i class="bi bi-note-text me-1"></i>
                            Catatan Pasien
                        </h6>
                        <div class="p-3 bg-light rounded">
                            {{ $visit->patient->catatan }}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            @endif
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
                        <a href="{{ route('patients.show', $visit->patient) }}" class="btn btn-primary">
                            <i class="bi bi-person-badge me-1"></i>
                            Lihat Detail Pasien
                        </a>
                        <a href="{{ route('visits.create') }}?patient_id={{ $visit->patient->id }}" class="btn btn-success">
                            <i class="bi bi-clipboard-plus me-1"></i>
                            Catat Kunjungan Baru
                        </a>
                        <a href="mailto:{{ $visit->patient->email }}" class="btn btn-outline-primary {{ !$visit->patient->email ? 'disabled' : '' }}">
                            <i class="bi bi-envelope me-1"></i>
                            Kirim Email
                        </a>
                        <a href="tel:{{ $visit->patient->telepon }}" class="btn btn-outline-success {{ !$visit->patient->telepon ? 'disabled' : '' }}">
                            <i class="bi bi-telephone me-1"></i>
                            Panggil
                        </a>
                        <hr>
                        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                            <i class="bi bi-trash me-1"></i>
                            Hapus Kunjungan
                        </button>
                    </div>
                </div>
            </div>

            <!-- Visit Timeline -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-clock-history me-2"></i>
                        Timeline Kunjungan
                    </h5>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        <div class="timeline-item">
                            <div class="timeline-marker bg-success"></div>
                            <div class="timeline-content">
                                <div class="fw-bold">Kunjungan Selesai</div>
                                <small class="text-muted">{{ $visit->visited_at->format('d F Y, H:i') }}</small>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-marker bg-primary"></div>
                            <div class="timeline-content">
                                <div class="fw-bold">Data Dicatat</div>
                                <small class="text-muted">{{ $visit->created_at->format('d F Y, H:i') }}</small>
                            </div>
                        </div>
                        @if($visit->created_at != $visit->updated_at)
                        <div class="timeline-item">
                            <div class="timeline-marker bg-warning"></div>
                            <div class="timeline-content">
                                <div class="fw-bold">Data Diperbarui</div>
                                <small class="text-muted">{{ $visit->updated_at->format('d F Y, H:i') }}</small>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Visit Stats -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-graph-up me-2"></i>
                        Statistik
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-2 text-center">
                        <div class="col-6">
                            <div class="bg-primary text-white p-3 rounded">
                                <div class="h5 mb-0">{{ $visit->patient->visits->count() }}</div>
                                <small>Total Kunjungan Pasien</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="bg-info text-white p-3 rounded">
                                <div class="h5 mb-0">
                                    @if($visit->visited_at->isToday())
                                        0
                                    @elseif($visit->visited_at->isYesterday())
                                        1
                                    @else
                                        {{ $visit->visited_at->diffInDays() }}
                                    @endif
                                </div>
                                <small>Hari yang Lalu</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Hapus Kunjungan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus data kunjungan ini?</p>
                <div class="alert alert-info">
                    <strong>Pasien:</strong> {{ $visit->patient->nama }}<br>
                    <strong>Tanggal:</strong> {{ $visit->visited_at->format('d F Y, H:i') }}<br>
                    <strong>ID Kunjungan:</strong> #{{ $visit->id }}
                </div>
                <p class="text-danger small">
                    <i class="bi bi-exclamation-triangle me-1"></i>
                    Tindakan ini tidak dapat dibatalkan dan akan menghapus seluruh data kunjungan ini.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form method="POST" action="{{ route('visits.destroy', $visit) }}" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash me-1"></i>
                        Ya, Hapus Kunjungan
                    </button>
                </form>
            </div>
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
    
    .timeline {
        position: relative;
        padding-left: 2rem;
    }
    
    .timeline-item {
        position: relative;
        padding-bottom: 1.5rem;
    }
    
    .timeline-item:not(:last-child)::before {
        content: '';
        position: absolute;
        left: -1.5rem;
        top: 1.5rem;
        width: 2px;
        height: calc(100% - 1rem);
        background-color: #e5e7eb;
    }
    
    .timeline-marker {
        position: absolute;
        left: -2rem;
        top: 0.25rem;
        width: 1rem;
        height: 1rem;
        border-radius: 50%;
        border: 2px solid white;
    }
    
    .timeline-content {
        margin-left: 0.5rem;
    }
</style>
@endpush
@endsection