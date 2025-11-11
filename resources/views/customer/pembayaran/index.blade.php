@extends('layouts.customer')

@section('title', 'Daftar Pembayaran')

@section('customer-content')
    <div class="container-fluid py-4">

        <h2 class="mb-4 fw-semibold text-primary-custom">Daftar Pembayaran</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light text-center">
                            <tr>
                                <th>No</th>
                                <th>Jadwal</th>
                                <th>Jumlah Tiket</th>
                                <th>Total Harga</th>
                                <th>Status Pembayaran</th>
                                <th>Bukti Transfer</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text text-center">
                            @forelse($pemesanans as $p)
                                <tr>
                                    <td class="fw-semibold">{{ $loop->iteration }}</td>
                                    <td>
                                        {{ $p->jadwal->asal }} → {{ $p->jadwal->tujuan }}<br>
                                        <small class="text-muted">
                                            {{ \Carbon\Carbon::parse($p->jadwal->tanggal_berangkat)->format('d M Y') }}
                                            jam {{ \Carbon\Carbon::parse($p->jadwal->jam_berangkat)->format('H:i') }}
                                        </small>
                                    </td>
                                    <td>{{ $p->jumlah_tiket }}</td>
                                    <td>Rp {{ number_format($p->total_harga, 0, ',', '.') }}</td>
                                    <td>
                                        @php
                                            $status = $p->pembayaran ? $p->pembayaran->status : 'belum_bayar';
                                            $badgeClass = match ($status) {
                                                'belum_dibayar' => 'bg-warning-subtle text-warning',
                                                'menunggu' => 'bg-info-subtle text-info',
                                                'valid' => 'bg-success-subtle text-success',
                                                'invalid' => 'bg-danger-subtle text-danger',
                                                default => 'bg-secondary-subtle text-secondary'
                                            };
                                        @endphp
                                        <span class="badge {{ $badgeClass }}">
                                            {{ ucwords(str_replace('_', ' ', $status)) }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($p->pembayaran && $p->pembayaran->bukti_pembayaran)
                                            <a href="{{ asset('storage/' . $p->pembayaran->bukti_pembayaran) }}" target="_blank"
                                                class="btn btn-outline-primary btn-sm">
                                                <i class="fas fa-eye me-1"></i> Lihat Bukti
                                            </a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        @if(!$p->pembayaran)
                                            <a href="{{ route('customer.pembayaran.create', $p->id) }}"
                                                class="btn btn-sm btn-primary-custom rounded-pill px-3 fw-semibold">
                                                <i class="fas fa-upload me-1"></i> Upload Bukti
                                            </a>
                                        @else
                                            <span class="text-muted">Selesai</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">
                                        Tidak ada data pembayaran.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
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
            background-color: #e9ecef !important;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(0, 123, 255, 0.05);
        }

        .badge {
            font-size: 0.85rem;
            padding: 0.45em 0.65em;
        }
    </style>
@endsection