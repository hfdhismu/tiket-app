@extends('layouts.customer')

@section('title', 'Pesan Tiket Baru')

@section('customer-content')
    <div class="container-fluid py-4">
        <h2 class="mb-4 fw-semibold text-primary-custom">Pesan Tiket Baru</h2>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('customer.pemesanan.store') }}" method="POST" class="needs-validation" novalidate>
            @csrf

            {{-- Jika datang dari dashboard --}}
            @if(isset($jadwal))
                <input type="hidden" name="jadwal_id" value="{{ $jadwal->id }}">

                <div class="card shadow-sm border-0 rounded-4 mb-4">
                    <div class="card-body">
                        <h5 class="fw-bold text-primary-custom mb-3">Detail Jadwal yang Dipilih</h5>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <p class="mb-1"><strong>Kode Jadwal:</strong></p>
                                <p class="text-muted">{{ $jadwal->kode_jadwal }}</p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-1"><strong>Asal:</strong></p>
                                <p class="text-muted">{{ $jadwal->asal }}</p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-1"><strong>Tujuan:</strong></p>
                                <p class="text-muted">{{ $jadwal->tujuan }}</p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-1"><strong>Tanggal Berangkat:</strong></p>
                                <p class="text-muted">{{ $jadwal->tanggal_berangkat }}</p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-1"><strong>Jam Berangkat:</strong></p>
                                <p class="text-muted">{{ $jadwal->jam_berangkat }}</p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-1"><strong>Harga per Tiket:</strong></p>
                                <p class="fw-semibold text-primary-custom">Rp {{ number_format($jadwal->harga, 0, ',', '.') }}
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-1"><strong>Sisa Kursi:</strong></p>
                                <p class="text-success fw-semibold">
                                    {{ $jadwal->kursis()->where('status', 'kosong')->count() }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            @else
                {{-- Jika buka manual dari menu Pemesanan --}}
                <div class="card shadow-sm border-0 rounded-4 mb-4">
                    <div class="card-body">
                        <h5 class="fw-bold text-primary-custom mb-3">Pilih Jadwal</h5>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Jadwal</label>
                            <select name="jadwal_id" class="form-select rounded-3" required>
                                <option value="">-- Pilih Jadwal --</option>
                                @foreach($jadwals as $jadwal)
                                    <option value="{{ $jadwal->id }}">
                                        {{ $jadwal->asal }} → {{ $jadwal->tujuan }} |
                                        {{ $jadwal->tanggal_berangkat }} jam {{ $jadwal->jam_berangkat }} |
                                        Harga: Rp {{ number_format($jadwal->harga, 0, ',', '.') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            @endif

            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body">
                    <h5 class="fw-bold text-primary-custom mb-3">Detail Pemesanan</h5>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Jumlah Tiket</label>
                        <input type="number" name="jumlah_tiket" class="form-control rounded-3" min="1" value="1" required>
                    </div>

                    <button type="submit" class="btn btn-primary-custom px-4 py-2 mt-2" style="color: white;">
                        <i class="fas fa-ticket-alt me-2"></i> Pesan Tiket
                    </button>
                </div>
            </div>
        </form>
    </div>

    <style>
        .card {
            transition: all 0.25s ease;
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
        }
        .form-select:focus,
        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.15);
        }
        .btn-primary-custom {
            background-color: #007bff;
            /* warna normal tombol */
            color: white;
            /* warna teks normal */
            transition: all 0.25s ease;
        }
        .btn-primary-custom:hover {
            background-color: #0056b3;
            /* warna background saat hover */
            color: white;
            /* tetap putih saat hover */
            text-decoration: none;
        }
    </style>
@endsection