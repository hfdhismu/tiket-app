@extends('layouts.admin')

@section('title', 'Surat Jalan')

@section('admin-content')
<div class="container-fluid py-4">

    <h2 class="mb-4 fw-semibold text-primary-custom">Daftar Surat Jalan</h2>

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
                            <th>Nomor Surat</th>
                            <th>Jadwal</th>
                            <th>Checker</th>
                            <th>Tanggal Cetak</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @forelse ($suratJalan as $sj)
                            <tr>
                                <td class="fw-semibold">{{ $loop->iteration }}</td>
                                <td class="fw-semibold text-primary">{{ $sj->nomor_surat }}</td>
                                <td>
                                    <div>
                                        <span class="fw-semibold">{{ $sj->jadwal->kode_jadwal }}</span><br>
                                        <small class="text-muted">
                                            {{ $sj->jadwal->asal }} → {{ $sj->jadwal->tujuan }}
                                        </small>
                                    </div>
                                </td>
                                <td>{{ $sj->checker }}</td>
                                <td>{{ \Carbon\Carbon::parse($sj->tanggal_cetak)->format('d M Y') }}</td>
                                <td>
                                    <a href="{{ route('admin.surat-jalan.show', $sj->id) }}" 
                                       class="btn btn-sm btn-primary-custom rounded-pill px-3 fw-semibold">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    Belum ada data surat jalan.
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
    }

    .table-hover tbody tr:hover {
        background-color: rgba(0, 123, 255, 0.05);
    }
</style>
@endsection
