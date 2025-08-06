@extends('layouts.app')

@section('title', 'Tambah Pasien Baru - Sistem Manajemen Klinik')

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
                    <li class="breadcrumb-item active">Tambah Baru</li>
                </ol>
            </nav>
            <h1 class="h3 mb-0 text-gray-900">
                <i class="bi bi-person-plus me-2"></i>
                Tambah Pasien Baru
            </h1>
            <p class="text-muted mb-0">Masukkan informasi lengkap pasien</p>
        </div>
        <div>
            <a href="{{ route('patients.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i>
                Kembali
            </a>
        </div>
    </div>

    <!-- Form -->
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-clipboard-data me-2"></i>
                        Formulir Data Pasien
                    </h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('patients.store') }}">
                        @csrf

                        <!-- Basic Information -->
                        <div class="mb-4">
                            <h6 class="text-primary mb-3">
                                <i class="bi bi-person me-1"></i>
                                Informasi Dasar
                            </h6>
                            
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="nama" class="form-label">
                                        Nama Lengkap <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                                           id="nama" name="nama" value="{{ old('nama') }}" 
                                           placeholder="Masukkan nama lengkap pasien" required>
                                    @error('nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                    <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" 
                                           id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
                                    @error('tanggal_lahir')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Contact Information -->
                        <div class="mb-4">
                            <h6 class="text-primary mb-3">
                                <i class="bi bi-telephone me-1"></i>
                                Informasi Kontak
                            </h6>
                            
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="email" class="form-label">
                                        Email <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-envelope"></i>
                                        </span>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                               id="email" name="email" value="{{ old('email') }}" 
                                               placeholder="contoh@email.com" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="telepon" class="form-label">Nomor Telepon</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-telephone"></i>
                                        </span>
                                        <input type="tel" class="form-control @error('telepon') is-invalid @enderror" 
                                               id="telepon" name="telepon" value="{{ old('telepon') }}" 
                                               placeholder="08123456789">
                                        @error('telepon')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="mb-4">
                            <h6 class="text-primary mb-3">
                                <i class="bi bi-geo-alt me-1"></i>
                                Alamat
                            </h6>
                            
                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="alamat" class="form-label">Alamat Lengkap</label>
                                    <textarea class="form-control @error('alamat') is-invalid @enderror" 
                                              id="alamat" name="alamat" rows="3" 
                                              placeholder="Masukkan alamat lengkap pasien...">{{ old('alamat') }}</textarea>
                                    @error('alamat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Medical Information -->
                        <div class="mb-4">
                            <h6 class="text-primary mb-3">
                                <i class="bi bi-heart-pulse me-1"></i>
                                Informasi Medis
                            </h6>
                            
                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="alergi" class="form-label">
                                        Alergi
                                        <span class="badge bg-warning text-dark ms-1">
                                            <i class="bi bi-exclamation-triangle"></i>
                                            Penting
                                        </span>
                                    </label>
                                    <textarea class="form-control @error('alergi') is-invalid @enderror" 
                                              id="alergi" name="alergi" rows="2" 
                                              placeholder="Tuliskan alergi yang dimiliki pasien (obat, makanan, dll.)...">{{ old('alergi') }}</textarea>
                                    @error('alergi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">
                                        <i class="bi bi-info-circle me-1"></i>
                                        Informasi ini sangat penting untuk keselamatan pasien
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Additional Notes -->
                        <div class="mb-4">
                            <h6 class="text-primary mb-3">
                                <i class="bi bi-note-text me-1"></i>
                                Catatan Tambahan
                            </h6>
                            
                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="catatan" class="form-label">Catatan</label>
                                    <textarea class="form-control @error('catatan') is-invalid @enderror" 
                                              id="catatan" name="catatan" rows="3" 
                                              placeholder="Catatan tambahan tentang pasien (kondisi khusus, riwayat penyakit, dll.)...">{{ old('catatan') }}</textarea>
                                    @error('catatan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="border-top pt-4">
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="bi bi-check-circle me-1"></i>
                                        Simpan Data Pasien
                                    </button>
                                </div>
                                <div class="col-md-3">
                                    <button type="reset" class="btn btn-outline-warning w-100">
                                        <i class="bi bi-arrow-clockwise me-1"></i>
                                        Reset Form
                                    </button>
                                </div>
                                <div class="col-md-3">
                                    <a href="{{ route('patients.index') }}" class="btn btn-outline-secondary w-100">
                                        <i class="bi bi-x-circle me-1"></i>
                                        Batal
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Help Card -->
            <div class="card mt-4">
                <div class="card-body">
                    <h6 class="card-title text-info">
                        <i class="bi bi-lightbulb me-1"></i>
                        Tips Mengisi Data Pasien
                    </h6>
                    <ul class="list-unstyled small mb-0">
                        <li class="mb-1">
                            <i class="bi bi-check-circle text-success me-1"></i>
                            <strong>Nama Lengkap:</strong> Gunakan nama sesuai identitas resmi
                        </li>
                        <li class="mb-1">
                            <i class="bi bi-check-circle text-success me-1"></i>
                            <strong>Email:</strong> Pastikan alamat email valid untuk komunikasi
                        </li>
                        <li class="mb-1">
                            <i class="bi bi-check-circle text-success me-1"></i>
                            <strong>Alergi:</strong> Informasi ini sangat penting untuk keselamatan pasien
                        </li>
                        <li class="mb-0">
                            <i class="bi bi-check-circle text-success me-1"></i>
                            <strong>Catatan:</strong> Tambahkan informasi penting seperti riwayat penyakit
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Auto format phone number
    document.getElementById('telepon').addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        
        if (value.startsWith('08')) {
            value = value;
        } else if (value.startsWith('628')) {
            value = '0' + value.substring(2);
        } else if (value.startsWith('8')) {
            value = '0' + value;
        }
        
        e.target.value = value;
    });

    // Calculate age from birth date
    document.getElementById('tanggal_lahir').addEventListener('change', function(e) {
        const birthDate = new Date(e.target.value);
        const today = new Date();
        const age = today.getFullYear() - birthDate.getFullYear();
        
        if (age > 0) {
            const ageDisplay = document.getElementById('age-display');
            if (ageDisplay) {
                ageDisplay.textContent = `Usia: ${age} tahun`;
            }
        }
    });
</script>
@endpush
@endsection