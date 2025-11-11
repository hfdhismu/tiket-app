@extends('layouts.admin')

@section('title', 'Edit Jadwal')

@section('admin-content')
<div class="container-fluid py-4">

    <h2 class="mb-4 fw-semibold text-primary-custom">Edit Jadwal</h2>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('admin.jadwal.update', $jadwal->id) }}" method="POST" class="needs-validation" novalidate>
        @csrf
        @method('PUT')

        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body">
                <h5 class="fw-bold text-primary-custom mb-3">Formulir Edit Jadwal</h5>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Asal</label>
                        <input type="text" name="asal" class="form-control rounded-3"
                               value="{{ old('asal', $jadwal->asal) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Tujuan</label>
                        <input type="text" name="tujuan" class="form-control rounded-3"
                               value="{{ old('tujuan', $jadwal->tujuan) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Tanggal Keberangkatan</label>
                        <input type="date" name="tanggal_berangkat" class="form-control rounded-3"
                               value="{{ old('tanggal_berangkat', $jadwal->tanggal_berangkat) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Jam Keberangkatan</label>
                        <input type="time" name="jam_berangkat" class="form-control rounded-3"
                               value="{{ old('jam_berangkat', $jadwal->jam_berangkat) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Jumlah Kursi</label>
                        <input type="number" name="jumlah_kursi" class="form-control rounded-3"
                               value="{{ old('jumlah_kursi', $jadwal->jumlah_kursi) }}" min="1" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Harga</label>
                        <input type="number" name="harga" class="form-control rounded-3"
                               value="{{ old('harga', $jadwal->harga) }}" required>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary-custom px-4 py-2 fw-semibold" style="color: white;">
                        <i class="fas fa-save me-2"></i> Update Jadwal
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

{{-- ===== Custom Style ===== --}}
<style>
    .card {
        transition: all 0.25s ease;
    }

    .card:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.15);
    }

    .btn-primary-custom {
        background-color: #007bff;
        color: white;
        border: none;
        transition: all 0.25s ease;
    }

    .btn-primary-custom:hover {
        background-color: #0056b3;
        color: white;
        text-decoration: none;
    }
</style>
@endsection
