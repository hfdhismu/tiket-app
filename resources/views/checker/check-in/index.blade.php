@extends('layouts.checker')

@section('title', 'Pengecekan Penumpang')

@section('checker-content')
<h1 class="mb-4 text-primary-custom">Pengecekan Penumpang</h1>

<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>No</th>
            <th>Customer</th>
            <th>Jadwal</th>
            <th>Kursi</th>
            <th>Status Check-In</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($checkIns as $check)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $check->user->name }}</td>
            <td>{{ $check->jadwal->tujuan }} - {{ $check->jadwal->tanggal }}</td>
            <td>{{ $check->kursi->nomor }}</td>
            <td>
                @if($check->status == 'checked_in')
                    <span class="badge bg-success">Sudah Hadir</span>
                @else
                    <span class="badge bg-warning">Belum Hadir</span>
                @endif
            </td>
            <td>
                @if($check->status != 'checked_in')
                <form action="{{ route('checker.checkin.update', $check->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button class="btn btn-sm btn-success">Check-In</button>
                </form>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
