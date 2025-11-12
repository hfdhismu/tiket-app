@extends('layouts.admin')

@section('title', 'Data Kursi')

@section('admin-content')
<div class="container-fluid py-4">
    <h2 class="mb-4 fw-semibold text-maroon">Data Kursi</h2>

    @if(session('success'))
        <div class="alert alert-success rounded-4 shadow-sm border-0">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light text-center">
                        <tr>
                            <th>No</th>
                            <th>Kode Jadwal</th>
                            <th>Jadwal</th>
                            <th>Nomor Kursi</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @forelse($kursi as $item)
                            <tr>
                                <td class="fw-semibold">{{ $loop->iteration }}</td>
                                <td>{{ $item->jadwal->kode_jadwal }}</td>
                                <td>
                                    {{ $item->jadwal->asal ?? '-' }} → {{ $item->jadwal->tujuan ?? '-' }}<br>
                                    <small class="text-muted">
                                        {{ \Carbon\Carbon::parse($item->jadwal->tanggal_berangkat)->format('d M Y') }}
                                    </small>
                                </td>
                                <td>{{ $item->nomor_kursi }}</td>
                                <td>
                                    @php
                                        $badgeClass = $item->status === 'kosong'
                                            ? 'bg-success-subtle text-success fw-bold'
                                            : 'bg-danger-subtle text-danger fw-bold';
                                    @endphp
                                    <span class="badge {{ $badgeClass }}">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    Belum ada data kursi.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- ===== Custom Style (Maroon Theme + Status Default Colors) ===== --}}
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
    }

    .table-hover tbody tr:hover {
        background-color: rgba(128, 0, 0, 0.05);
    }

    .fw-semibold {
        font-weight: 600;
    }

    .alert-success {
        background-color: #f3e8e8 !important;
        color: #800000 !important;
        font-weight: 600;
    }

    /* Badge status tetap hijau & merah */
    .bg-success-subtle {
        background-color: #e8f6ec !important;
    }

    .bg-danger-subtle {
        background-color: #fde8e8 !important;
    }

    .text-success {
        color: #198754 !important;
    }

    .text-danger {
        color: #dc3545 !important;
    }

    .badge {
        font-size: 0.85rem;
        padding: 0.45em 0.65em;
        border-radius: 0.5rem;
        font-weight: 500;
    }

    .rounded-pill {
        border-radius: 50rem !important;
    }
</style>
@endsection
