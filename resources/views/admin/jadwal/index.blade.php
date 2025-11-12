@extends('layouts.admin')

@section('title', 'Master Data Jadwal')

@section('admin-content')
<div class="container-fluid py-4">

    <h2 class="mb-4 fw-semibold text-maroon">Master Data Jadwal</h2>

    @if(session('success'))
        <div class="alert alert-success rounded-4 shadow-sm border-0">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.jadwal.create') }}" class="btn btn-maroon mb-3 rounded-pill px-3 fw-semibold shadow-sm">
        + Tambah Jadwal
    </a>

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light text-center">
                        <tr>
                            <th>No</th>
                            <th>Kode Jadwal</th>
                            <th>Asal</th>
                            <th>Tujuan</th>
                            <th>Tanggal Keberangkatan</th>
                            <th>Jam Keberangkatan</th>
                            <th>Jumlah Kursi</th>
                            <th>Sisa Kursi</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @forelse ($jadwals as $jadwal)
                            <tr>
                                <td class="fw-semibold">{{ $loop->iteration }}</td>
                                <td>{{ $jadwal->kode_jadwal }}</td>
                                <td>{{ $jadwal->asal }}</td>
                                <td>{{ $jadwal->tujuan }}</td>
                                <td>{{ \Carbon\Carbon::parse($jadwal->tanggal_berangkat)->format('d M Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($jadwal->jam_berangkat)->format('H:i') }}</td>
                                <td>{{ $jadwal->jumlah_kursi }}</td>
                                <td>{{ $jadwal->sisa_kursi }}</td>
                                <td>Rp {{ number_format($jadwal->harga, 0, ',', '.') }}</td>
                                <td>
                                    <a href="{{ route('admin.jadwal.edit', $jadwal->id) }}"
                                       class="btn btn-sm btn-warning rounded-pill px-3 fw-semibold me-1 shadow-sm">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.jadwal.destroy', $jadwal->id) }}"
                                          method="POST"
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-sm btn-danger rounded-pill px-3 fw-semibold shadow-sm"
                                                onclick="return confirm('Yakin hapus jadwal ini?')">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center text-muted py-4">
                                    Belum ada jadwal.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

{{-- ===== Custom Style (Maroon Theme) ===== --}}
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

    .rounded-pill {
        border-radius: 50rem !important;
    }

    .alert-success {
        background-color: #f3e8e8 !important;
        color: #800000 !important;
        font-weight: 600;
    }

    /* optional: ubah warna tombol warning & danger agar serasi */
    .btn-warning {
        background-color: #ffcc00;
        border: none;
        color: #4b0000;
        transition: 0.25s;
    }

    .btn-warning:hover {
        background-color: #e6b800;
        color: #4b0000;
    }

    .btn-danger {
        background-color: #a00000;
        border: none;
        transition: 0.25s;
    }

    .btn-danger:hover {
        background-color: #7a0000;
    }
</style>
@endsection
