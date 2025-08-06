@extends('layouts.app')

@section('title', 'Data Kunjungan - Sistem Manajemen Klinik')

@section('content')
<div class="py-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-900">
                <i class="bi bi-clipboard-check me-2"></i>
                Data Kunjungan Pasien
            </h1>
            <p class="text-muted mb-0">Rekam jejak kunjungan pasien ke klinik</p>
        </div>
        <div>
            <a href="{{ route('visits.create') }}" class="btn btn-success">
                <i class="bi bi-clipboard-plus me-1"></i>
                Catat Kunjungan Baru
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card stats-card">
                <div class="card-body text-center">
                    <div class="display-6 fw-bold">{{ $visits->total() }}</div>
                    <div class="small text-white-50">Total Kunjungan</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stats-card success">
                <div class="card-body text-center">
                    <div class="display-6 fw-bold">{{ \App\Models\PatientVisit::whereDate('visited_at', today())->count() }}</div>
                    <div class="small text-white-50">Kunjungan Hari Ini</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stats-card warning">
                <div class="card-body text-center">
                    <div class="display-6 fw-bold">{{ \App\Models\PatientVisit::whereBetween('visited_at', [now()->startOfWeek(), now()->endOfWeek()])->count() }}</div>
                    <div class="small text-white-50">Minggu Ini</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stats-card info">
                <div class="card-body text-center">
                    <div class="display-6 fw-bold">{{ \App\Models\PatientVisit::whereMonth('visited_at', now()->month)->count() }}</div>
                    <div class="small text-white-50">Bulan Ini</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Filter -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('visits.index') }}" class="row g-3">
                <div class="col-md-4">
                    <label for="search" class="form-label">Cari Kunjungan</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" class="form-control" id="search" name="search" 
                               value="{{ request('search') }}" placeholder="Nama pasien...">
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="date_from" class="form-label">Dari Tanggal</label>
                    <input type="date" class="form-control" id="date_from" name="date_from" 
                           value="{{ request('date_from') }}">
                </div>
                <div class="col-md-3">
                    <label for="date_to" class="form-label">Sampai Tanggal</label>
                    <input type="date" class="form-control" id="date_to" name="date_to" 
                           value="{{ request('date_to') }}">
                </div>
                <div class="col-md-2">
                    <label class="form-label">&nbsp;</label>
                    <div>
                        <button type="submit" class="btn btn-outline-primary">
                            <i class="bi bi-filter me-1"></i>
                            Filter
                        </button>
                        <a href="{{ route('visits.index') }}" class="btn btn-outline-secondary ms-1">
                            <i class="bi bi-arrow-clockwise"></i>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Visits Table -->
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">
                <i class="bi bi-table me-2"></i>
                Daftar Kunjungan
                <span class="badge bg-secondary ms-2">{{ $visits->total() }} kunjungan</span>
            </h5>
        </div>
        <div class="card-body p-0">
            @if($visits->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Pasien</th>
                                <th>Tanggal & Waktu Kunjungan</th>
                                <th>Status</th>
                                <th>Info Pasien</th>
                                <th>Durasi</th>
                                <th width="120">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($visits as $visit)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm bg-success text-white rounded-circle me-3 d-flex align-items-center justify-content-center">
                                            {{ substr($visit->patient->nama, 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="fw-bold">
                                                <a href="{{ route('patients.show', $visit->patient) }}" class="text-decoration-none">
                                                    {{ $visit->patient->nama }}
                                                </a>
                                            </div>
                                            @if($visit->patient->telepon)
                                            <small class="text-muted">
                                                <i class="bi bi-telephone me-1"></i>
                                                {{ $visit->patient->telepon }}
                                            </small>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="fw-bold">{{ $visit->visited_at->format('d F Y') }}</div>
                                    <small class="text-muted">
                                        <i class="bi bi-clock me-1"></i>
                                        {{ $visit->visited_at->format('H:i') }}
                                    </small>
                                </td>
                                <td>
                                    <span class="badge bg-success">
                                        <i class="bi bi-check-circle me-1"></i>
                                        Selesai
                                    </span>
                                </td>
                                <td>
                                    @if($visit->patient->alergi)
                                    <span class="badge bg-warning text-dark mb-1">
                                        <i class="bi bi-exclamation-triangle me-1"></i>
                                        Alergi
                                    </span>
                                    @endif
                                    @if($visit->patient->tanggal_lahir)
                                    <div class="small text-muted">
                                        <i class="bi bi-person me-1"></i>
                                        {{ \Carbon\Carbon::parse($visit->patient->tanggal_lahir)->age }} tahun
                                    </div>
                                    @endif
                                </td>
                                <td>
                                    <div class="small">{{ $visit->visited_at->diffForHumans() }}</div>
                                    @if($visit->visited_at->isToday())
                                    <span class="badge bg-info">Hari ini</span>
                                    @elseif($visit->visited_at->isYesterday())
                                    <span class="badge bg-secondary">Kemarin</span>
                                    @elseif($visit->visited_at->isCurrentWeek())
                                    <span class="badge bg-primary">Minggu ini</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('visits.show', $visit) }}" 
                                           class="btn btn-sm btn-outline-primary" title="Lihat Detail">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('patients.show', $visit->patient) }}" 
                                           class="btn btn-sm btn-outline-info" title="Data Pasien">
                                            <i class="bi bi-person"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-danger" 
                                                title="Hapus" data-bs-toggle="modal" 
                                                data-bs-target="#deleteModal{{ $visit->id }}">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>

                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="deleteModal{{ $visit->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Apakah Anda yakin ingin menghapus data kunjungan:</p>
                                                    <div class="alert alert-info">
                                                        <strong>Pasien:</strong> {{ $visit->patient->nama }}<br>
                                                        <strong>Tanggal:</strong> {{ $visit->visited_at->format('d F Y, H:i') }}
                                                    </div>
                                                    <p class="text-danger small">
                                                        <i class="bi bi-exclamation-triangle me-1"></i>
                                                        Tindakan ini tidak dapat dibatalkan.
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <form method="POST" action="{{ route('visits.destroy', $visit) }}" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">
                                                            <i class="bi bi-trash me-1"></i>
                                                            Ya, Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <div class="mb-3">
                        <i class="bi bi-clipboard-x display-1 text-muted"></i>
                    </div>
                    <h5 class="text-muted">Belum ada data kunjungan</h5>
                    <p class="text-muted">Mulai dengan mencatat kunjungan pasien pertama.</p>
                    <a href="{{ route('visits.create') }}" class="btn btn-success">
                        <i class="bi bi-clipboard-plus me-1"></i>
                        Catat Kunjungan Pertama
                    </a>
                </div>
            @endif
        </div>
        
        @if($visits->hasPages())
        <div class="card-footer">
            <div class="d-flex justify-content-between align-items-center">
                <div class="small text-muted">
                    Menampilkan {{ $visits->firstItem() }} sampai {{ $visits->lastItem() }} 
                    dari {{ $visits->total() }} hasil
                </div>
                {{ $visits->links('pagination::bootstrap-4') }}
            </div>
        </div>
        @endif
    </div>
</div>

@push('styles')
<style>
    .avatar-sm {
        width: 40px;
        height: 40px;
        font-weight: 600;
    }
</style>
@endpush
@endsection