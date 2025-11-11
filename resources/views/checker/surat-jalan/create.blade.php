@extends('layouts.checker')

@section('title', 'Buat Surat Jalan')

@section('checker-content')
<h1 class="mb-4 text-primary-custom">Buat Surat Jalan</h1>

<form action="{{ route('checker.surat-jalan.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label class="form-label">Pilih Jadwal</label>
        <select name="jadwal_id" class="form-control" required>
            <option value="">-- Pilih Jadwal --</option>
            @foreach ($jadwals as $jadwal)
                <option value="{{ $jadwal->id }}">
                    {{ $jadwal->kode_jadwal }} - {{ $jadwal->asal }} ke {{ $jadwal->tujuan }}
                    ({{ $jadwal->tanggal_berangkat }} {{ $jadwal->jam_berangkat }})
                </option>
            @endforeach
        </select>
    </div>

    <button class="btn btn-primary-custom">Simpan Surat Jalan</button>
</form>
@endsection
