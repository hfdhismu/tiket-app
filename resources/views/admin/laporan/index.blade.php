@extends('layouts.admin')

@section('title', 'Laporan Pemesanan')

@section('admin-content')
    <div class="container-fluid py-4">

        <h2 class="mb-4 fw-semibold text-primary-custom">Laporan Pemesanan</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="mb-3">
            <a href="{{ route('admin.laporan.cetak') }}" class="btn btn-primary-custom px-4 py-2 fw-semibold rounded-pill">
                <i class="fas fa-file-export me-2"></i> Export PDF / Excel
            </a>
        </div>

        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light text-center">
                            <tr>
                                <th>No</th>
                                <th>Customer</th>
                                <th>Jadwal</th>
                                <th>Jumlah Tiket</th>
                                <th>Total Harga</th>
                                <th>Status Pemesanan</th>
                                <th>Status Pembayaran</th>
                                <th>Surat Jalan</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @forelse ($pemesanans as $p)
                                <tr>
                                    <td class="fw-semibold">{{ $loop->iteration }}</td>
                                    <td>{{ $p->user?->name ?? 'Tidak ditemukan' }}</td>
                                    <td>
                                        <div>
                                            <span class="fw-semibold">
                                                {{ $p->jadwal?->asal ?? '-' }} → {{ $p->jadwal?->tujuan ?? '-' }}
                                            </span><br>
                                            <small class="text-muted">
                                                {{ $p->jadwal?->tanggal_berangkat ?? '-' }} jam
                                                {{ $p->jadwal?->jam_berangkat ?? '-' }}
                                            </small>
                                        </div>
                                    </td>
                                    <td>{{ $p->jumlah_tiket }}</td>
                                    <td>Rp {{ number_format($p->total_harga, 0, ',', '.') }}</td>

                                    {{-- Status Pemesanan --}}
                                    <td>
                                        @php
                                            $statusPemesanan = strtolower($p->status ?? '');
                                            $badgeClass = match ($statusPemesanan) {
                                                'dibayar' => 'bg-success-subtle text-success',
                                                'selesai' => 'bg-success-subtle text-success',
                                                'batal' => 'bg-danger-subtle text-danger',
                                                'pending', 'belum_dibayar' => 'bg-info-subtle text-info',
                                                default => 'bg-secondary-subtle text-secondary',
                                            };
                                        @endphp
                                        <span class="badge {{ $badgeClass }} fw-bold">
                                            {{ ucfirst(str_replace('_', ' ', $p->status ?? '-')) }}
                                        </span>
                                    </td>

                                    {{-- Status Pembayaran --}}
                                    <td>
                                        @if($p->pembayaran)
                                            @php
                                                $statusPembayaran = strtolower($p->pembayaran->status);
                                                $badgePay = match ($statusPembayaran) {
                                                    'valid', 'terkonfirmasi' => 'bg-success-subtle text-success',
                                                    'pending', 'menunggu' => 'bg-warning-subtle text-warning',
                                                    'invalid' => 'bg-danger-subtle text-danger',
                                                    default => 'bg-secondary-subtle text-secondary',
                                                };
                                            @endphp
                                            <span class="badge {{ $badgePay }} fw-bold">
                                                {{ ucfirst(str_replace('_', ' ', $p->pembayaran->status)) }}
                                            </span>
                                        @else
                                            <span class="badge bg-secondary-subtle text-secondary fw-bold">Belum bayar</span>
                                        @endif
                                    </td>

                                    {{-- Surat Jalan --}}
                                    <td>
                                        @if($p->suratJalan)
                                            <a href="{{ route('admin.surat-jalan.show', $p->suratJalan->id) }}"
                                                class="btn btn-sm btn-primary-custom rounded-pill px-3 fw-semibold">
                                                Lihat
                                            </a>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted py-4">
                                        Belum ada data pemesanan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    {{-- ===== Custom Style ===== --}}
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

        .bg-success-subtle {
            background-color: #e8f6ec !important;
        }

        .bg-warning-subtle {
            background-color: #fff4e5 !important;
        }

        .bg-info-subtle {
            background-color: #e5f4ff !important;
        }

        .bg-danger-subtle {
            background-color: #fde8e8 !important;
        }

        .bg-secondary-subtle {
            background-color: #f2f2f2 !important;
        }

        .badge {
            font-size: 0.85rem;
            padding: 0.45em 0.65em;
            font-weight: 600;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(0, 123, 255, 0.05);
        }
    </style>
@endsection