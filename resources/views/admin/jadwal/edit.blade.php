@extends('layouts.admin')

@section('title', 'Edit Jadwal')

@section('admin-content')
<div class="container-fluid py-4">

    <h2 class="mb-4 fw-semibold text-maroon">Edit Jadwal</h2>

    @if(session('error'))
        <div class="alert alert-danger rounded-4 shadow-sm border-0">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('admin.jadwal.update', $jadwal->id) }}" method="POST" class="needs-validation" novalidate>
        @csrf
        @method('PUT')

        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body">
                <h5 class="fw-bold text-maroon mb-3">Formulir Edit Jadwal</h5>

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
                    <button type="submit" class="btn btn-maroon px-4 py-2 fw-semibold shadow-sm">
                        <i class="fas fa-save me-2"></i> Update Jadwal
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
</style>
@endsection