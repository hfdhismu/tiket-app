@extends('layouts.checker')

@section('title', 'Daftar Surat Jalan Checker')

@section('checker-content')
    <div class="container-fluid py-4">

        <h2 class="mb-4 fw-semibold text-maroon">Daftar Surat Jalan</h2>

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
                                    <td class="fw-semibold text-maroon">{{ $sj->nomor_surat }}</td>
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
                                        <a href="{{ route('checker.surat-jalan.show', $sj->id) }}" 
                                           class="btn btn-sm btn-outline-maroon rounded-3 px-3 fw-semibold">
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

    {{-- ===== Custom Style (Tema Maroon Checker Selaras Admin) ===== --}}
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

        .table-hover tbody tr:hover {
            background-color: rgba(128, 0, 0, 0.05);
        }

        .alert-success {
            background-color: #e8f6ec !important;
            color: #198754 !important;
            font-weight: 600;
            border-radius: 0.4rem;
        }

        .btn {
            border-radius: 0.4rem !important;
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
    </style>
@endsection
