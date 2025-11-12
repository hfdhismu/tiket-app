@extends('layouts.customer')

@section('title', 'Upload Bukti Pembayaran')

@section('customer-content')
<div class="container-fluid py-4">

    <h2 class="mb-4 fw-semibold text-maroon">Upload Bukti Pembayaran</h2>

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

                <button type="submit" class="btn btn-maroon rounded-pill px-3 fw-semibold">
                    <i class="fas fa-upload me-1"></i> Upload Bukti
                </button>

            </form>

        </div>
    </div>

</div>

<style>
    /* Warna tema utama */
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
        background-color: #660000;
        color: #fff;
    }

    .card {
        transition: all 0.25s ease;
        border-left: 4px solid #800000;
    }

    .card:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 18px rgba(128, 0, 0, 0.15);
    }

    .form-label {
        color: #4b0000;
    }

    .form-control:disabled {
        background-color: #f8f8f8;
        border-color: #d1bcbc;
        color: #555;
    }
</style>
@endsection
