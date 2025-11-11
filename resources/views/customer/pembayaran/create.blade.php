@extends('layouts.customer')

@section('title', 'Upload Bukti Pembayaran')

@section('customer-content')
<div class="container-fluid py-4">

    <h2 class="mb-4 fw-semibold text-primary-custom">Upload Bukti Pembayaran</h2>

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body">

            <form action="{{ route('customer.pembayaran.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="pemesanan_id" value="{{ $pemesanan->id }}">

                <div class="mb-3">
                    <label class="form-label fw-semibold">Jadwal</label>
                    <input type="text" class="form-control" value="{{ $pemesanan->jadwal->asal }} → {{ $pemesanan->jadwal->tujuan }} | {{ \Carbon\Carbon::parse($pemesanan->jadwal->tanggal_berangkat)->format('d M Y') }} jam {{ \Carbon\Carbon::parse($pemesanan->jadwal->jam_berangkat)->format('H:i') }}" disabled>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Jumlah Tiket</label>
                    <input type="text" class="form-control" value="{{ $pemesanan->jumlah_tiket }}" disabled>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Bukti Transfer (maks 5MB)</label>
                    <input type="file" name="bukti_transfer" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary-custom rounded-pill px-3 fw-semibold">
                    <i class="fas fa-upload me-1"></i> Upload Bukti
                </button>

            </form>

        </div>
    </div>

</div>

<style>
    .btn-primary-custom {
        background-color: #007bff;
        color: white;
        border: none;
        transition: all 0.25s ease;
    }
    .btn-primary-custom:hover {
        background-color: #0056b3;
        color: white;
    }
    .card {
        transition: all 0.25s ease;
    }
    .card:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 18px rgba(0,0,0,0.08);
    }
</style>
@endsection
