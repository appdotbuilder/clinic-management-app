@extends('layouts.app')

@section('title', 'Edit ' . $patient->nama . ' - Sistem Manajemen Klinik')

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
                    <li class="breadcrumb-item">
                        <a href="{{ route('patients.show', $patient) }}">{{ $patient->nama }}</a>
                    </li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </nav>
            <h1 class="h3 mb-0 text-gray-900">
                <i class="bi bi-pencil me-2"></i>
                Edit Data Pasien
            </h1>
            <p class="text-muted mb-0">Perbarui informasi pasien {{ $patient->nama }}</p>
        </div>
        <div>
            <a href="{{ route('patients.show', $patient) }}" class="btn btn-outline-secondary">
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
                        Formulir Edit Data Pasien
                    </h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('patients.update', $patient) }}">
                        @csrf
                        @method('PUT')

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
                                           id="nama" name="nama" value="{{ old('nama', $patient->nama) }}" 
                                           placeholder="Masukkan nama lengkap pasien" required>
                                    @error('nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                    <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" 
                                           id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir', $patient->tanggal_lahir) }}">
                                    @error('tanggal_lahir')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    @if($patient->tanggal_lahir)
                                        <div class="form-text text-info">
                                            <i class="bi bi-info-circle me-1"></i>
                                            Usia saat ini: {{ \Carbon\Carbon::parse($patient->tanggal_lahir)->age }} tahun
                                        </div>
                                    @endif
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
                                               id="email" name="email" value="{{ old('email', $patient->email) }}" 
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
                                               id="telepon" name="telepon" value="{{ old('telepon', $patient->telepon) }}" 
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
                                              placeholder="Masukkan alamat lengkap pasien...">{{ old('alamat', $patient->alamat) }}</textarea>
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
                                              placeholder="Tuliskan alergi yang dimiliki pasien (obat, makanan, dll.)...">{{ old('alergi', $patient->alergi) }}</textarea>
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
                                              placeholder="Catatan tambahan tentang pasien (kondisi khusus, riwayat penyakit, dll.)...">{{ old('catatan', $patient->catatan) }}</textarea>
                                    @error('catatan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Metadata Info -->
                        <div class="mb-4">
                            <div class="alert alert-info" role="alert">
                                <div class="d-flex">
                                    <i class="bi bi-info-circle me-2"></i>
                                    <div>
                                        <h6 class="alert-heading mb-1">Informasi Registrasi</h6>
                                        <small>
                                            Pasien terdaftar pada: <strong>{{ $patient->created_at->format('d F Y, H:i') }}</strong><br>
                                            Terakhir diperbarui: <strong>{{ $patient->updated_at->format('d F Y, H:i') }}</strong><br>
                                            Total kunjungan: <strong>{{ $patient->visits->count() }} kali</strong>
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="border-top pt-4">
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="bi bi-check-circle me-1"></i>
                                        Simpan Perubahan
                                    </button>
                                </div>
                                <div class="col-md-3">
                                    <button type="reset" class="btn btn-outline-warning w-100" onclick="resetToOriginal()">
                                        <i class="bi bi-arrow-clockwise me-1"></i>
                                        Reset
                                    </button>
                                </div>
                                <div class="col-md-3">
                                    <a href="{{ route('patients.show', $patient) }}" class="btn btn-outline-secondary w-100">
                                        <i class="bi bi-x-circle me-1"></i>
                                        Batal
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Warning Card -->
            <div class="card mt-4 border-warning">
                <div class="card-header bg-warning text-dark">
                    <h6 class="card-title mb-0">
                        <i class="bi bi-exclamation-triangle me-1"></i>
                        ⚠️ Peringatan Penting
                    </h6>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled small mb-0">
                        <li class="mb-2">
                            <i class="bi bi-shield-exclamation text-warning me-1"></i>
                            <strong>Data Alergi:</strong> Pastikan informasi alergi akurat untuk keselamatan pasien
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-envelope-exclamation text-info me-1"></i>
                            <strong>Email:</strong> Perubahan email akan mempengaruhi komunikasi dengan pasien
                        </li>
                        <li class="mb-0">
                            <i class="bi bi-clock-history text-secondary me-1"></i>
                            <strong>Riwayat:</strong> Perubahan data tidak akan mempengaruhi riwayat kunjungan yang sudah ada
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Store original values for reset
    const originalValues = {
        nama: '{{ $patient->nama }}',
        email: '{{ $patient->email }}',
        telepon: '{{ $patient->telepon ?? '' }}',
        tanggal_lahir: '{{ $patient->tanggal_lahir ?? '' }}',
        alamat: '{{ $patient->alamat ?? '' }}',
        alergi: '{{ $patient->alergi ?? '' }}',
        catatan: '{{ $patient->catatan ?? '' }}'
    };

    function resetToOriginal() {
        Object.keys(originalValues).forEach(key => {
            const element = document.getElementById(key);
            if (element) {
                element.value = originalValues[key];
            }
        });
    }

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
</script>
@endpush
@endsection