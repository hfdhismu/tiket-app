@extends('layouts.admin')

@section('title', 'Edit Kursi')

@section('admin-content')
<div class="container-fluid py-4">

    <h2 class="mb-4 fw-semibold text-primary-custom">Edit Kursi</h2>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('admin.kursi.update', $kursi->id) }}" method="POST" class="needs-validation" novalidate>
        @csrf
        @method('PUT')

        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body">
                <h5 class="fw-bold text-primary-custom mb-3">Formulir Edit Kursi</h5>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Pilih Jadwal</label>
                        <select name="jadwal_id" class="form-select rounded-3" required>
                            <option value="">-- Pilih Jadwal --</option>
                            @foreach($jadwal as $item)
                                <option value="{{ $item->id }}" {{ $kursi->jadwal_id == $item->id ? 'selected' : '' }}>
                                    {{ $item->asal }} → {{ $item->tujuan }} ({{ \Carbon\Carbon::parse($item->tanggal_berangkat)->format('d M Y') }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Nomor Kursi</label>
                        <input type="text" name="nomor_kursi" class="form-control rounded-3"
                               value="{{ old('nomor_kursi', $kursi->nomor_kursi) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Status</label>
                        <select name="status" class="form-select rounded-3" required>
                            <option value="kosong" {{ $kursi->status == 'kosong' ? 'selected' : '' }}>Kosong</option>
                            <option value="terisi" {{ $kursi->status == 'terisi' ? 'selected' : '' }}>Terisi</option>
                        </select>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary-custom px-4 py-2 fw-semibold" style="color: white;">
                        <i class="fas fa-save me-2"></i> Update Kursi
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

    .form-control:focus, .form-select:focus {
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
