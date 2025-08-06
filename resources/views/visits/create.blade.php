@extends('layouts.app')

@section('title', 'Catat Kunjungan Baru - Sistem Manajemen Klinik')

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
                    <li class="breadcrumb-item active">Catat Baru</li>
                </ol>
            </nav>
            <h1 class="h3 mb-0 text-gray-900">
                <i class="bi bi-clipboard-plus me-2"></i>
                Catat Kunjungan Baru
            </h1>
            <p class="text-muted mb-0">Rekam kunjungan pasien ke klinik</p>
        </div>
        <div>
            <a href="{{ route('visits.index') }}" class="btn btn-outline-secondary">
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
                        Formulir Kunjungan Pasien
                    </h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('visits.store') }}">
                        @csrf

                        <!-- Patient Selection -->
                        <div class="mb-4">
                            <h6 class="text-primary mb-3">
                                <i class="bi bi-person me-1"></i>
                                Pilih Pasien
                            </h6>
                            
                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="patient_id" class="form-label">
                                        Pasien <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-select @error('patient_id') is-invalid @enderror" 
                                            id="patient_id" name="patient_id" required>
                                        <option value="">Pilih pasien...</option>
                                        @foreach($patients as $patient)
                                            <option value="{{ $patient->id }}" 
                                                    {{ old('patient_id', request('patient_id')) == $patient->id ? 'selected' : '' }}
                                                    data-email="{{ $patient->email }}"
                                                    data-phone="{{ $patient->telepon }}"
                                                    data-birth="{{ $patient->tanggal_lahir }}"
                                                    data-allergy="{{ $patient->alergi }}"
                                                    data-notes="{{ $patient->catatan }}">
                                                {{ $patient->nama }}
                                                @if($patient->telepon) - {{ $patient->telepon }} @endif
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('patient_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">
                                        <i class="bi bi-info-circle me-1"></i>
                                        Jika pasien belum terdaftar, <a href="{{ route('patients.create') }}" target="_blank">daftarkan pasien baru</a> terlebih dahulu.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Patient Info Display -->
                        <div id="patient-info" class="mb-4" style="display: none;">
                            <div class="alert alert-info" role="alert">
                                <h6 class="alert-heading">
                                    <i class="bi bi-person-badge me-1"></i>
                                    Informasi Pasien
                                </h6>
                                <div id="patient-details">
                                    <!-- Patient details will be populated by JavaScript -->
                                </div>
                            </div>
                        </div>

                        <!-- Visit Information -->
                        <div class="mb-4">
                            <h6 class="text-primary mb-3">
                                <i class="bi bi-calendar-check me-1"></i>
                                Informasi Kunjungan
                            </h6>
                            
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="visited_at" class="form-label">
                                        Tanggal & Waktu Kunjungan
                                    </label>
                                    <input type="datetime-local" 
                                           class="form-control @error('visited_at') is-invalid @enderror" 
                                           id="visited_at" name="visited_at" 
                                           value="{{ old('visited_at', now()->format('Y-m-d\TH:i')) }}">
                                    @error('visited_at')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">
                                        <i class="bi bi-clock me-1"></i>
                                        Kosongkan untuk menggunakan waktu saat ini
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Status Kunjungan</label>
                                    <div class="form-control-plaintext">
                                        <span class="badge bg-success fs-6">
                                            <i class="bi bi-check-circle me-1"></i>
                                            Aktif
                                        </span>
                                        <small class="text-muted ms-2">Kunjungan akan tercatat sebagai selesai</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Actions -->
                        <div class="mb-4">
                            <h6 class="text-primary mb-3">
                                <i class="bi bi-lightning-charge me-1"></i>
                                Aksi Cepat
                            </h6>
                            
                            <div class="row g-2">
                                <div class="col-md-4">
                                    <button type="button" class="btn btn-outline-info w-100" onclick="setCurrentTime()">
                                        <i class="bi bi-clock me-1"></i>
                                        Gunakan Waktu Sekarang
                                    </button>
                                </div>
                                <div class="col-md-4">
                                    <button type="button" class="btn btn-outline-warning w-100" onclick="setMorningTime()">
                                        <i class="bi bi-sunrise me-1"></i>
                                        Jam Pagi (08:00)
                                    </button>
                                </div>
                                <div class="col-md-4">
                                    <button type="button" class="btn btn-outline-success w-100" onclick="setEveningTime()">
                                        <i class="bi bi-sunset me-1"></i>
                                        Jam Sore (14:00)
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="border-top pt-4">
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-success w-100">
                                        <i class="bi bi-check-circle me-1"></i>
                                        Catat Kunjungan
                                    </button>
                                </div>
                                <div class="col-md-3">
                                    <button type="reset" class="btn btn-outline-warning w-100" onclick="resetForm()">
                                        <i class="bi bi-arrow-clockwise me-1"></i>
                                        Reset Form
                                    </button>
                                </div>
                                <div class="col-md-3">
                                    <a href="{{ route('visits.index') }}" class="btn btn-outline-secondary w-100">
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
                        Tips Mencatat Kunjungan
                    </h6>
                    <ul class="list-unstyled small mb-0">
                        <li class="mb-1">
                            <i class="bi bi-check-circle text-success me-1"></i>
                            <strong>Pilih Pasien:</strong> Pastikan memilih pasien yang tepat dari dropdown
                        </li>
                        <li class="mb-1">
                            <i class="bi bi-check-circle text-success me-1"></i>
                            <strong>Waktu Kunjungan:</strong> Secara default akan menggunakan waktu saat ini
                        </li>
                        <li class="mb-1">
                            <i class="bi bi-check-circle text-success me-1"></i>
                            <strong>Informasi Alergi:</strong> Perhatikan peringatan alergi jika ada
                        </li>
                        <li class="mb-0">
                            <i class="bi bi-check-circle text-success me-1"></i>
                            <strong>Pasien Baru:</strong> Jika belum terdaftar, daftarkan dulu sebagai pasien baru
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Handle patient selection change
    document.getElementById('patient_id').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const patientInfo = document.getElementById('patient-info');
        const patientDetails = document.getElementById('patient-details');
        
        if (this.value) {
            const email = selectedOption.dataset.email || 'Tidak ada';
            const phone = selectedOption.dataset.phone || 'Tidak ada';
            const birth = selectedOption.dataset.birth || 'Tidak diketahui';
            const allergy = selectedOption.dataset.allergy || '';
            const notes = selectedOption.dataset.notes || '';
            
            let age = 'Tidak diketahui';
            if (birth !== 'Tidak diketahui') {
                const birthDate = new Date(birth);
                const today = new Date();
                age = today.getFullYear() - birthDate.getFullYear() + ' tahun';
            }
            
            let html = `
                <div class="row">
                    <div class="col-md-6">
                        <strong>Email:</strong> ${email}<br>
                        <strong>Telepon:</strong> ${phone}<br>
                        <strong>Usia:</strong> ${age}
                    </div>
                    <div class="col-md-6">
            `;
            
            if (allergy) {
                html += `
                    <div class="alert alert-warning alert-sm p-2 mb-2">
                        <i class="bi bi-exclamation-triangle me-1"></i>
                        <strong>Alergi:</strong> ${allergy}
                    </div>
                `;
            }
            
            if (notes) {
                html += `
                    <div class="alert alert-info alert-sm p-2">
                        <i class="bi bi-note-text me-1"></i>
                        <strong>Catatan:</strong> ${notes}
                    </div>
                `;
            }
            
            html += `</div></div>`;
            
            patientDetails.innerHTML = html;
            patientInfo.style.display = 'block';
        } else {
            patientInfo.style.display = 'none';
        }
    });
    
    // Time helper functions
    function setCurrentTime() {
        const now = new Date();
        const formattedTime = now.toISOString().slice(0, 16);
        document.getElementById('visited_at').value = formattedTime;
    }
    
    function setMorningTime() {
        const today = new Date();
        today.setHours(8, 0, 0, 0);
        const formattedTime = today.toISOString().slice(0, 16);
        document.getElementById('visited_at').value = formattedTime;
    }
    
    function setEveningTime() {
        const today = new Date();
        today.setHours(14, 0, 0, 0);
        const formattedTime = today.toISOString().slice(0, 16);
        document.getElementById('visited_at').value = formattedTime;
    }
    
    function resetForm() {
        document.getElementById('patient-info').style.display = 'none';
        setCurrentTime();
    }
    
    // Initialize if patient_id is already selected (from URL param)
    document.addEventListener('DOMContentLoaded', function() {
        const patientSelect = document.getElementById('patient_id');
        if (patientSelect.value) {
            patientSelect.dispatchEvent(new Event('change'));
        }
    });
</script>
@endpush
@endsection