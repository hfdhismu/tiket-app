@extends('layouts.admin')

@section('title', 'Detail Surat Jalan')

@section('admin-content')
    <div class="container-fluid py-4">

        <h2 class="mb-4 fw-semibold text-maroon">Detail Surat Jalan</h2>

        {{-- ===== Informasi Surat Jalan ===== --}}
        <div class="card shadow-sm border-0 rounded-4 mb-4">
            <div class="card-body">
                <h5 class="fw-bold text-maroon mb-3">Informasi Surat Jalan</h5>

                <div class="row g-3">
                    <div class="col-md-6">
                        <p class="mb-1 fw-semibold text-secondary">Nomor Surat</p>
                        <p class="mb-3">{{ $suratJalan->nomor_surat }}</p>
                    </div>

                    <div class="col-md-6">
                        <p class="mb-1 fw-semibold text-secondary">Checker</p>
                        <p class="mb-3">{{ $suratJalan->checker }}</p>
                    </div>

                    <div class="col-md-6">
                        <p class="mb-1 fw-semibold text-secondary">Kode Jadwal</p>
                        <p class="mb-3">{{ $suratJalan->jadwal->kode_jadwal }}</p>
                    </div>

                    <div class="col-md-6">
                        <p class="mb-1 fw-semibold text-secondary">Rute</p>
                        <p class="mb-3">{{ $suratJalan->jadwal->asal }} → {{ $suratJalan->jadwal->tujuan }}</p>
                    </div>

                    <div class="col-md-6">
                        <p class="mb-1 fw-semibold text-secondary">Tanggal Keberangkatan</p>
                        <p class="mb-3">
                            {{ \Carbon\Carbon::parse($suratJalan->jadwal->tanggal_berangkat)->format('d M Y') }}
                        </p>
                    </div>

                    <div class="col-md-6">
                        <p class="mb-1 fw-semibold text-secondary">Jam Keberangkatan</p>
                        <p class="mb-3">{{ $suratJalan->jadwal->jam_berangkat }}</p>
                    </div>

                    <div class="col-md-6">
                        <p class="mb-1 fw-semibold text-secondary">Tanggal Cetak</p>
                        <p class="mb-0">
                            {{ \Carbon\Carbon::parse($suratJalan->tanggal_cetak)->format('d M Y') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- ===== Daftar Penumpang ===== --}}
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body">
                <h5 class="fw-bold text-maroon mb-3">Daftar Penumpang</h5>

                @if($suratJalan->pemesanans->isEmpty())
                    <p class="text-muted mb-0">Belum ada penumpang yang memesan tiket untuk jadwal ini.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Penumpang</th>
                                    <th>Status Check-in</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @foreach($suratJalan->pemesanans as $index => $pemesan)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $pemesan->user->name ?? '-' }}</td>
                                        <td>
                                            @if($pemesan->check_in)
                                                <span class="badge bg-success-subtle text-success fw-bold px-3 py-2 rounded-2"
                                                    style="font-size: 0.85rem;">
                                                    Sudah
                                                </span>
                                            @else
                                                <span class="badge bg-danger-subtle text-danger fw-bold px-3 py-2 rounded-2"
                                                    style="font-size: 0.85rem;">
                                                    Belum
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

                {{-- ===== Tombol Aksi ===== --}}
                <div class="mt-4 d-flex justify-content-between">
                    <a href="{{ route('admin.surat-jalan.index') }}"
                        class="btn btn-secondary-custom rounded-3 px-4 fw-semibold">
                        <i class="fas fa-arrow-left me-2"></i> Kembali
                    </a>

                    @if($suratJalan->pemesanans->count() > 0 && $suratJalan->pemesanans->every(fn($p) => $p->check_in))
                        <a href="{{ route('admin.surat-jalan.cetak', $suratJalan->id) }}"
                            class="btn btn-maroon rounded-3 px-4 fw-semibold text-white">
                            <i class="fas fa-print me-2"></i> Cetak
                        </a>
                    @else
                        <button class="btn btn-outline-maroon rounded-3 px-4 fw-semibold" disabled>
                            <i class="fas fa-clock me-2"></i> Menunggu Check-In
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- ===== Custom Style ===== --}}
    <style>
        .text-maroon {
            color: #800000 !important;
        }

        .btn-maroon {
            background-color: #800000;
            border: none;
            color: white;
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

        .btn-secondary-custom {
            background-color: #6c757d;
            border: none;
            color: #fff;
            transition: all 0.25s ease;
        }

        .btn-secondary-custom:hover {
            background-color: #5a6268;
        }

        .card {
            transition: all 0.25s ease;
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 18px rgba(128, 0, 0, 0.15);
        }

        .bg-success-subtle {
            background-color: #e8f6ec !important;
        }

        .bg-danger-subtle {
            background-color: #fdecec !important;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(128, 0, 0, 0.05);
        }

        .rounded-3 {
            border-radius: 0.4rem !important;
        }

        .rounded-2 {
            border-radius: 0.3rem !important;
        }
    </style>
@endsection
