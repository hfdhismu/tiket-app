@extends('layouts.checker')

@section('title', 'Detail Surat Jalan')

@section('checker-content')
<div class="container-fluid py-4">

    <h2 class="mb-4 fw-semibold text-primary-custom">Detail Surat Jalan</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- ===== Informasi Surat Jalan ===== --}}
    <div class="card shadow-sm border-0 rounded-4 mb-4">
        <div class="card-body">
            <h5 class="fw-bold text-primary-custom mb-3">Informasi Surat Jalan</h5>

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
                    <p class="mb-3">{{ \Carbon\Carbon::parse($suratJalan->jadwal->tanggal_berangkat)->format('d M Y') }}</p>
                </div>

                <div class="col-md-6">
                    <p class="mb-1 fw-semibold text-secondary">Jam Keberangkatan</p>
                    <p class="mb-3">{{ $suratJalan->jadwal->jam_berangkat }}</p>
                </div>

                <div class="col-md-6">
                    <p class="mb-1 fw-semibold text-secondary">Tanggal Cetak</p>
                    <p class="mb-0">{{ \Carbon\Carbon::parse($suratJalan->tanggal_cetak)->format('d M Y') }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- ===== Daftar Penumpang ===== --}}
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body">
            <h5 class="fw-bold text-primary-custom mb-3">Daftar Penumpang</h5>

            @if($suratJalan->pemesanans->isEmpty())
                <p class="text-muted mb-0">Belum ada penumpang yang memesan tiket untuk jadwal ini.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light text-center">
                            <tr>
                                <th>No</th>
                                <th>Nama Penumpang</th>
                                <th>Rute & Waktu</th>
                                <th>Jumlah Tiket</th>
                                <th>Total Harga</th>
                                <th>Status Check-in</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach($suratJalan->pemesanans as $index => $pemesan)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $pemesan->user->name ?? '-' }}</td>
                                    <td>
                                        <div>
                                            {{ $pemesan->jadwal->asal }} → {{ $pemesan->jadwal->tujuan }}<br>
                                            <small class="text-muted">{{ $pemesan->jadwal->jam_berangkat }}</small>
                                        </div>
                                    </td>
                                    <td>{{ $pemesan->jumlah_tiket }}</td>
                                    <td>Rp {{ number_format($pemesan->total_harga, 0, ',', '.') }}</td>
                                    <td>
                                        @if($pemesan->check_in)
                                            <span class="badge bg-success-subtle text-success fw-bold px-3 py-2"
                                                    style="font-size: 0.85rem;">Sudah</span>
                                        @else
                                            <span class="badge bg-warning-subtle text-warning fw-bold px-3 py-2"
                                                    style="font-size: 0.85rem;">Belum</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if(!$pemesan->check_in && $pemesan->status === 'dibayar')
                                            <form action="{{ route('checker.checkin', $pemesan->id) }}" method="POST">
                                                @csrf
                                                <button class="btn btn-sm btn-success rounded-pill px-3 fw-semibold">
                                                    Check-in
                                                </button>
                                            </form>
                                        @elseif($pemesan->status !== 'dibayar')
                                            <span class="text-danger fw-semibold">Belum bayar</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

            <div class="mt-4">
                <a href="{{ route('checker.surat-jalan.index') }}" 
                   class="btn btn-secondary rounded-pill px-4 fw-semibold">
                    <i class="fas fa-arrow-left me-2"></i> Kembali
                </a>
            </div>
        </div>
    </div>

</div>

{{-- ===== Custom Style ===== --}}
<style>
    .card {
        transition: all 0.25s ease;
    }

    .card:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
    }

    .btn-success {
        background-color: #28a745;
        border: none;
        transition: all 0.25s ease;
    }

    .btn-success:hover {
        background-color: #1e7e34;
        transform: translateY(-2px);
    }

    .bg-success-subtle {
        background-color: #e8f6ec !important;
    }

    .bg-warning-subtle {
        background-color: #fff4e5 !important;
    }

    .text-secondary {
        color: #6c757d !important;
    }

    .table-hover tbody tr:hover {
        background-color: rgba(0, 123, 255, 0.05);
    }
</style>
@endsection
