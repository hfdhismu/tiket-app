@extends('layouts.customer')

@section('title', 'Detail Pemesanan')

@section('customer-content')
    <div class="container-fluid py-4">

        <h2 class="mb-4 fw-semibold text-primary-custom">Detail Pemesanan</h2>

        {{-- ===== Info Pemesanan ===== --}}
        <div class="card shadow-sm border-0 rounded-4 mb-4">
            <div class="card-body">
                <h5 class="fw-bold mb-3 text-primary-custom">Informasi Pemesanan</h5>

                <div class="row g-3">
                    <div class="col-md-6">
                        <p class="mb-1"><strong>Kode Pemesanan:</strong></p>
                        <p class="text-muted">{{ $pemesanan->kode_pemesanan }}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-1"><strong>Status:</strong></p>
                        @php
                            $badgeClass = match ($pemesanan->status) {
                                'belum_dibayar' => 'bg-warning-subtle text-warning',
                                'pending' => 'bg-info-subtle text-info',
                                'dibayar' => 'bg-success-subtle text-success',
                                'batal' => 'bg-danger-subtle text-danger',
                                default => 'bg-secondary-subtle text-secondary'
                            };
                        @endphp
                        <span class="badge {{ $badgeClass }}">
                            {{ ucwords(str_replace('_', ' ', $pemesanan->status)) }}
                        </span>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-1"><strong>Jumlah Tiket:</strong></p>
                        <p class="text-muted">{{ $pemesanan->jumlah_tiket }}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-1"><strong>Total Harga:</strong></p>
                        <p class="fw-semibold text-primary-custom">Rp
                            {{ number_format($pemesanan->total_harga, 0, ',', '.') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- ===== Info Jadwal ===== --}}
        <div class="card shadow-sm border-0 rounded-4 mb-4">
            <div class="card-body">
                <h5 class="fw-bold mb-3 text-primary-custom">Detail Jadwal</h5>

                <div class="row g-3">
                    <div class="col-md-6">
                        <p class="mb-1"><strong>Kode Jadwal:</strong></p>
                        <p class="text-muted">{{ $pemesanan->jadwal->kode_jadwal }}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-1"><strong>Asal:</strong></p>
                        <p class="text-muted">{{ $pemesanan->jadwal->asal }}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-1"><strong>Tujuan:</strong></p>
                        <p class="text-muted">{{ $pemesanan->jadwal->tujuan }}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-1"><strong>Tanggal Berangkat:</strong></p>
                        <p class="text-muted">{{ $pemesanan->jadwal->tanggal_berangkat }}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-1"><strong>Jam Berangkat:</strong></p>
                        <p class="text-muted">{{ $pemesanan->jadwal->jam_berangkat }}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-1"><strong>Harga per Tiket:</strong></p>
                        <p class="fw-semibold text-primary-custom">Rp
                            {{ number_format($pemesanan->jadwal->harga, 0, ',', '.') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- ===== Bukti Pembayaran ===== --}}
        <div class="card shadow-sm border-0 rounded-4 mb-4">
            <div class="card-body">
                <h5 class="fw-bold mb-3 text-primary-custom">Bukti Pembayaran</h5>

                @if($pemesanan->pembayaran && $pemesanan->pembayaran->bukti_pembayaran)
                    <p>
                        <a href="{{ asset('storage/' . $pemesanan->pembayaran->bukti_pembayaran) }}" target="_blank"
                            class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-eye me-1"></i> Lihat Bukti
                        </a>
                    </p>
                @else
                    <p class="text-muted">Belum ada bukti pembayaran.</p>
                @endif

                @if(
                        in_array($pemesanan->status, ['belum_bayar', 'pending']) &&
                        (!$pemesanan->pembayaran || !$pemesanan->pembayaran->bukti_pembayaran)
                    )
                    <a href="{{ route('customer.pembayaran.create', $pemesanan->id) }}" class="btn btn-primary-custom mt-2">
                        <i class="fas fa-upload me-1"></i> Upload Bukti Pembayaran
                    </a>
                @endif

            </div>
        </div>

    </div>

    <style>
        .card {
            transition: all 0.25s ease;
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
        }

        .btn-primary-custom {
            background-color: #007bff;
            color: white;
            transition: all 0.25s ease;
        }

        .btn-primary-custom:hover {
            background-color: #0056b3;
            color: white;
            text-decoration: none;
        }

        .badge {
            font-size: 0.9rem;
            padding: 0.45em 0.65em;
        }

        .bg-warning-subtle {
            background-color: #fff3cd !important;
        }

        .bg-info-subtle {
            background-color: #d1ecf1 !important;
        }

        .bg-success-subtle {
            background-color: #d4edda !important;
        }

        .bg-danger-subtle {
            background-color: #f8d7da !important;
        }

        .bg-secondary-subtle {
            background-color: #e2e3e5 !important;
        }
    </style>
@endsection