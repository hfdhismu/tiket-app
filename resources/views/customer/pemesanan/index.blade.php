@extends('layouts.customer')

@section('title', 'Daftar Pemesanan')

@section('customer-content')
    <div class="container-fluid py-4">

        <h2 class="mb-4 fw-semibold text-primary-custom">Daftar Pemesanan Saya</h2>

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
                                <th>Kode Pemesanan</th>
                                <th>Jadwal</th>
                                <th>Jumlah Tiket</th>
                                <th>Total Harga</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @forelse($pemesanan as $p)
                                <tr>
                                    <td class="fw-semibold">{{ $loop->iteration }}</td>
                                    <td>{{ $p->kode_pemesanan }}</td>
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
                                            $badgeClass = match ($p->status) {
                                                'belum_dibayar' => 'bg-warning-subtle text-warning',
                                                'pending' => 'bg-info-subtle text-info',
                                                'dibayar' => 'bg-success-subtle text-success',
                                                'batal' => 'bg-danger-subtle text-danger',
                                                default => 'bg-secondary-subtle text-secondary'
                                            };
                                        @endphp
                                        <span class="badge {{ $badgeClass }}">
                                            {{ ucwords(str_replace('_', ' ', $p->status)) }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('customer.pemesanan.show', $p->id) }}"
                                            class="btn btn-sm btn-primary-custom rounded-pill px-3 fw-semibold">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">
                                        Belum ada pemesanan.
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

        .table-hover tbody tr:hover {
            background-color: rgba(0, 123, 255, 0.05);
        }

        .badge {
            font-size: 0.85rem;
            padding: 0.45em 0.65em;
        }
    </style>
@endsection