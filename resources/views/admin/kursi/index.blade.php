@extends('layouts.admin')

@section('title', 'Data Kursi')

@section('admin-content')
<div class="container-fluid py-4">
    <h2 class="mb-4 fw-semibold text-primary-custom">Data Kursi</h2>

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
                            <th>Kode Jadwal</th>
                            <th>Jadwal</th>
                            <th>Nomor Kursi</th>
                            <th>Status</th>
                            {{-- <th>Aksi</th> --}}
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
                                            ? 'bg-success-subtle text-success'
                                            : 'bg-danger-subtle text-danger';
                                    @endphp
                                    <span class="badge {{ $badgeClass }}">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                </td>
                                {{-- <td>
                                    <a href="{{ route('admin.kursi.edit', $item->id) }}"
                                        class="btn btn-sm btn-primary-custom rounded-pill px-3 fw-semibold me-1">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.kursi.destroy', $item->id) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Hapus kursi ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger rounded-pill px-3 fw-semibold">
                                            Hapus
                                        </button>
                                    </form>
                                </td> --}}
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
