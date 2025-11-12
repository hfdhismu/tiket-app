@extends('layouts.admin')

@section('title', 'Pemesanan Tiket')

@section('admin-content')
<div class="container-fluid py-4">

    <h2 class="mb-4 fw-semibold text-maroon">Daftar Pemesanan Tiket</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

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
                            <th>Bukti Transfer</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-center text-dark">
                        @forelse ($pemesanan as $p)
                            <tr>
                                <td class="fw-semibold">{{ $loop->iteration }}</td>
                                <td>{{ $p->user?->name ?? 'Data user tidak ditemukan' }}</td>
                                <td>
                                    <div>
                                        <span class="fw-semibold">
                                            {{ $p->jadwal?->asal ?? '-' }} → {{ $p->jadwal?->tujuan ?? '-' }}
                                        </span><br>
                                        <small class="text-muted">
                                            {{ $p->jadwal?->tanggal_berangkat ?? '-' }} jam {{ $p->jadwal?->jam_berangkat ?? '-' }}
                                        </small>
                                    </div>
                                </td>
                                <td>{{ $p->jumlah_tiket ?? '-' }}</td>
                                <td>Rp {{ number_format($p->total_harga ?? 0, 0, ',', '.') }}</td>

                                {{-- Status Pemesanan --}}
                                <td>
                                    @php
                                        $statusPemesanan = strtolower($p->status ?? '');
                                        $badgeClass = match($statusPemesanan) {
                                            'belum_dibayar' => 'bg-warning-subtle text-warning',
                                            'pending' => 'bg-info-subtle text-info',
                                            'dibayar' => 'bg-success-subtle text-success',
                                            'batal' => 'bg-danger-subtle text-danger',
                                            default => 'bg-secondary-subtle text-secondary'
                                        };
                                    @endphp
                                    <span class="badge {{ $badgeClass }} fw-bold rounded-2">
                                        {{ ucfirst(str_replace('_', ' ', $p->status ?? '-')) }}
                                    </span>
                                </td>

                                {{-- Status Pembayaran --}}
                                <td>
                                    @if($p->pembayaran)
                                        @php
                                            $statusPembayaran = strtolower($p->pembayaran->status);
                                            $badgePay = match($statusPembayaran) {
                                                'menunggu' => 'bg-warning-subtle text-warning',
                                                'valid' => 'bg-success-subtle text-success',
                                                'invalid' => 'bg-danger-subtle text-danger',
                                                default => 'bg-secondary-subtle text-secondary'
                                            };
                                        @endphp
                                        <span class="badge {{ $badgePay }} fw-bold rounded-2">
                                            {{ ucfirst($p->pembayaran->status) }}
                                        </span>
                                    @else
                                        <span class="badge bg-secondary-subtle text-secondary fw-bold rounded-2">Belum bayar</span>
                                    @endif
                                </td>

                                {{-- Bukti Transfer --}}
                                <td>
                                    @if($p->pembayaran && $p->pembayaran->bukti_pembayaran)
                                        <a href="{{ asset('storage/' . $p->pembayaran->bukti_pembayaran) }}"
                                           target="_blank" class="btn btn-sm btn-outline-maroon rounded-3 px-3 fw-semibold">
                                            Lihat
                                        </a>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>

                                {{-- Aksi --}}
                                <td>
                                    @if($p->pembayaran && $p->pembayaran->status === 'menunggu' && $p->pembayaran->bukti_pembayaran)
                                        <form action="{{ route('admin.pemesanan.konfirmasi', $p->pembayaran->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-maroon rounded-3 px-3 fw-semibold">
                                                Konfirmasi
                                            </button>
                                        </form>
                                    @elseif(!$p->pembayaran)
                                        <span class="text-muted">Belum bayar / Tunggu bukti</span>
                                    @else
                                        <span class="badge bg-success-subtle text-success fw-bold rounded-2">Terkonfirmasi</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center text-muted py-4">
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

{{-- ===== Custom Style (Tema Maroon Seragam) ===== --}}
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
        background-color: #660000;
        color: #fff;
    }

    .btn-outline-maroon {
        border: 1.5px solid #800000;
        color: #800000;
        background-color: transparent;
        transition: all 0.25s ease;
    }

    .btn-outline-maroon:hover {
        background-color: #800000;
        color: #fff;
    }

    .card {
        transition: all 0.25s ease;
    }

    .bg-success-subtle {
        background-color: #e8f6ec !important;
        color: #198754 !important;
        font-weight: 600;
    }

    .bg-warning-subtle {
        background-color: #fff4e5 !important;
        color: #ffc107 !important;
        font-weight: 600;
    }

    .bg-danger-subtle {
        background-color: #fdecec !important;
        color: #b30000 !important;
        font-weight: 600;
    }

    .bg-info-subtle {
        background-color: #f2e6ff !important;
        color: #6f42c1 !important;
        font-weight: 600;
    }

    .bg-secondary-subtle {
        background-color: #f2f2f2 !important;
        color: #6c757d !important;
        font-weight: 600;
    }

    .badge {
        font-size: 0.85rem;
        padding: 0.45em 0.65em;
        font-weight: 600;
        border-radius: 0.3rem !important;
    }

    .rounded-3 {
        border-radius: 0.4rem !important;
    }

    .fw-semibold {
        font-weight: 600 !important;
    }

    .table-hover tbody tr:hover {
        background-color: rgba(128, 0, 0, 0.05);
    }

    .table th,
    .table td {
        color: #333 !important; /* Biar tidak abu */
    }
</style>
@endsection
