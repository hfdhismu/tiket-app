@extends('layouts.admin')

@section('title', 'Tambah Jadwal')

@section('admin-content')
<div class="container-fluid py-4">

    <h2 class="mb-4 fw-semibold text-maroon">Tambah Jadwal</h2>

    {{-- Tampilkan semua error validasi --}}
    @if ($errors->any())
        <div class="alert alert-danger rounded-4 shadow-sm border-0">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.jadwal.store') }}" method="POST" class="needs-validation" novalidate>
        @csrf

        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body">
                <h5 class="fw-bold text-maroon mb-3">Formulir Jadwal Baru</h5>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Asal</label>
                        <input type="text" name="asal" 
                               class="form-control rounded-3 @error('asal') is-invalid @enderror" 
                               value="{{ old('asal') }}" required>
                        @error('asal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Tujuan</label>
                        <input type="text" name="tujuan" 
                               class="form-control rounded-3 @error('tujuan') is-invalid @enderror" 
                               value="{{ old('tujuan') }}" required>
                        @error('tujuan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Tanggal Keberangkatan</label>
                        <input type="date" name="tanggal_berangkat" 
                               class="form-control rounded-3 @error('tanggal_berangkat') is-invalid @enderror"
                               value="{{ old('tanggal_berangkat') }}" 
                               min="{{ date('Y-m-d') }}" required>
                        @error('tanggal_berangkat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Jam Keberangkatan</label>
                        <input type="time" name="jam_berangkat" 
                               class="form-control rounded-3 @error('jam_berangkat') is-invalid @enderror" 
                               value="{{ old('jam_berangkat') }}" required>
                        @error('jam_berangkat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Jumlah Kursi</label>
                        <input type="number" name="jumlah_kursi" 
                               class="form-control rounded-3 @error('jumlah_kursi') is-invalid @enderror" 
                               value="{{ old('jumlah_kursi', 10) }}" min="1" required>
                        @error('jumlah_kursi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Harga</label>
                        <input type="number" name="harga" 
                               class="form-control rounded-3 @error('harga') is-invalid @enderror" 
                               value="{{ old('harga') }}" required>
                        @error('harga')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mt-3">
                    <small class="text-muted">
                        * Saat jadwal disimpan, Surat Jalan dan Kursi akan otomatis dibuat.
                    </small>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-maroon px-4 py-2 fw-semibold shadow-sm">
                        <i class="fas fa-save me-2"></i> Simpan Jadwal
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

{{-- ===== Custom Style (Maroon Theme) ===== --}}
<style>
    .text-maroon {
        color: #800000 !important;
    }

    .btn-maroon {
        background-color: #800000;
        color: #fff;
        border: none;
        transition: all 0.25s ease;
    }

    .btn-maroon:hover {
        background-color: #5a0000;
        color: #fff;
        text-decoration: none;
    }

    .form-control:focus {
        border-color: #800000;
        box-shadow: 0 0 0 0.2rem rgba(128, 0, 0, 0.15);
    }

    .card {
        transition: all 0.25s ease;
    }

    .card:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
    }

    .alert-danger {
        background-color: #fceaea;
        color: #800000;
        border: 1px solid #e0b3b3;
        font-weight: 600;
    }

    .is-invalid {
        border-color: #dc3545;
    }

    .invalid-feedback {
        display: block;
    }
</style>
@endsection
