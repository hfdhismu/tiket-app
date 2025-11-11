@extends('layouts.admin')

@section('title', 'Master Data Jadwal')

@section('admin-content')
<div class="container-fluid py-4">

    <h2 class="mb-4 fw-semibold text-primary-custom">Master Data Jadwal</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.jadwal.create') }}" class="btn btn-primary-custom mb-3 rounded-pill px-3 fw-semibold">
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
                                       class="btn btn-sm btn-warning rounded-pill px-3 fw-semibold me-1">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.jadwal.destroy', $jadwal->id) }}"
                                          method="POST"
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-sm btn-danger rounded-pill px-3 fw-semibold"
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

    .table-hover tbody tr:hover {
        background-color: rgba(0, 123, 255, 0.05);
    }

    .badge {
        font-size: 0.85rem;
        padding: 0.45em 0.65em;
    }

    .fw-semibold {
        font-weight: 600;
    }

    .rounded-pill {
        border-radius: 50rem !important;
    }
</style>
@endsection
