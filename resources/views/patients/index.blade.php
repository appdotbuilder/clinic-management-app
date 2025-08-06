@extends('layouts.app')

@section('title', 'Data Pasien - Sistem Manajemen Klinik')

@section('content')
<div class="py-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-900">
                <i class="bi bi-people me-2"></i>
                Data Pasien
            </h1>
            <p class="text-muted mb-0">Kelola informasi lengkap pasien klinik</p>
        </div>
        <div>
            <a href="{{ route('patients.create') }}" class="btn btn-primary">
                <i class="bi bi-person-plus me-1"></i>
                Tambah Pasien Baru
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card stats-card">
                <div class="card-body text-center">
                    <div class="display-6 fw-bold">{{ $patients->total() }}</div>
                    <div class="small text-white-50">Total Pasien</div>
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
                    <div class="display-6 fw-bold">{{ \App\Models\Patient::whereMonth('created_at', now()->month)->count() }}</div>
                    <div class="small text-white-50">Pasien Baru Bulan Ini</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stats-card info">
                <div class="card-body text-center">
                    <div class="display-6 fw-bold">{{ \App\Models\PatientVisit::count() }}</div>
                    <div class="small text-white-50">Total Kunjungan</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Filter -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('patients.index') }}" class="row g-3">
                <div class="col-md-4">
                    <label for="search" class="form-label">Cari Pasien</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" class="form-control" id="search" name="search" 
                               value="{{ request('search') }}" placeholder="Nama, email, atau telepon...">
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" name="status">
                        <option value="">Semua Status</option>
                        <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Aktif</option>
                        <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Non-aktif</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="sort" class="form-label">Urutkan</label>
                    <select class="form-select" id="sort" name="sort">
                        <option value="created_at_desc" {{ request('sort', 'created_at_desc') === 'created_at_desc' ? 'selected' : '' }}>Terbaru</option>
                        <option value="created_at_asc" {{ request('sort') === 'created_at_asc' ? 'selected' : '' }}>Terlama</option>
                        <option value="nama_asc" {{ request('sort') === 'nama_asc' ? 'selected' : '' }}>Nama A-Z</option>
                        <option value="nama_desc" {{ request('sort') === 'nama_desc' ? 'selected' : '' }}>Nama Z-A</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">&nbsp;</label>
                    <div>
                        <button type="submit" class="btn btn-outline-primary">
                            <i class="bi bi-filter me-1"></i>
                            Filter
                        </button>
                        <a href="{{ route('patients.index') }}" class="btn btn-outline-secondary ms-1">
                            <i class="bi bi-arrow-clockwise"></i>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Patients Table -->
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">
                <i class="bi bi-table me-2"></i>
                Daftar Pasien
                <span class="badge bg-secondary ms-2">{{ $patients->total() }} pasien</span>
            </h5>
        </div>
        <div class="card-body p-0">
            @if($patients->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Pasien</th>
                                <th>Kontak</th>
                                <th>Info Tambahan</th>
                                <th>Kunjungan</th>
                                <th>Terdaftar</th>
                                <th width="120">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($patients as $patient)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm bg-primary text-white rounded-circle me-3 d-flex align-items-center justify-content-center">
                                            {{ substr($patient->nama, 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="fw-bold">{{ $patient->nama }}</div>
                                            <small class="text-muted">
                                                {{ $patient->tanggal_lahir ? \Carbon\Carbon::parse($patient->tanggal_lahir)->age . ' tahun' : 'Usia tidak diketahui' }}
                                            </small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        @if($patient->email)
                                        <div class="small">
                                            <i class="bi bi-envelope me-1"></i>
                                            {{ $patient->email }}
                                        </div>
                                        @endif
                                        @if($patient->telepon)
                                        <div class="small">
                                            <i class="bi bi-telephone me-1"></i>
                                            {{ $patient->telepon }}
                                        </div>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    @if($patient->alergi)
                                    <span class="badge bg-warning text-dark mb-1">
                                        <i class="bi bi-exclamation-triangle me-1"></i>
                                        Alergi
                                    </span>
                                    @endif
                                    @if($patient->catatan)
                                    <div class="small text-truncate" style="max-width: 150px;" title="{{ $patient->catatan }}">
                                        <i class="bi bi-note-text me-1"></i>
                                        {{ Str::limit($patient->catatan, 30) }}
                                    </div>
                                    @endif
                                </td>
                                <td>
                                    @if($patient->visits_count > 0)
                                        <span class="badge bg-success">
                                            {{ $patient->visits_count }} kunjungan
                                        </span>
                                        @if($patient->visits->first())
                                        <div class="small text-muted">
                                            Terakhir: {{ $patient->visits->first()->visited_at->format('d/m/Y') }}
                                        </div>
                                        @endif
                                    @else
                                        <span class="badge bg-secondary">Belum ada kunjungan</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="small">{{ $patient->created_at->format('d/m/Y') }}</div>
                                    <div class="small text-muted">{{ $patient->created_at->diffForHumans() }}</div>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('patients.show', $patient) }}" 
                                           class="btn btn-sm btn-outline-primary" title="Lihat Detail">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('patients.edit', $patient) }}" 
                                           class="btn btn-sm btn-outline-warning" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-danger" 
                                                title="Hapus" data-bs-toggle="modal" 
                                                data-bs-target="#deleteModal{{ $patient->id }}">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>

                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="deleteModal{{ $patient->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Apakah Anda yakin ingin menghapus data pasien <strong>{{ $patient->nama }}</strong>?</p>
                                                    <p class="text-danger small">
                                                        <i class="bi bi-exclamation-triangle me-1"></i>
                                                        Tindakan ini tidak dapat dibatalkan dan akan menghapus semua data kunjungan pasien.
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <form method="POST" action="{{ route('patients.destroy', $patient) }}" class="d-inline">
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
                        <i class="bi bi-people display-1 text-muted"></i>
                    </div>
                    <h5 class="text-muted">Belum ada data pasien</h5>
                    <p class="text-muted">Mulai dengan menambahkan pasien pertama Anda.</p>
                    <a href="{{ route('patients.create') }}" class="btn btn-primary">
                        <i class="bi bi-person-plus me-1"></i>
                        Tambah Pasien Baru
                    </a>
                </div>
            @endif
        </div>
        
        @if($patients->hasPages())
        <div class="card-footer">
            <div class="d-flex justify-content-between align-items-center">
                <div class="small text-muted">
                    Menampilkan {{ $patients->firstItem() }} sampai {{ $patients->lastItem() }} 
                    dari {{ $patients->total() }} hasil
                </div>
                {{ $patients->links('pagination::bootstrap-4') }}
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