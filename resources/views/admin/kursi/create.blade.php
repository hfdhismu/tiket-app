@extends('layouts.admin')

@section('title', 'Tambah Kursi')

@section('admin-content')
<h1 class="mb-4 text-primary-custom">Tambah Kursi</h1>

<form action="{{ route('admin.kursi.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label class="form-label">Pilih Jadwal</label>
        <select name="jadwal_id" class="form-control" required>
            <option value="">-- Pilih Jadwal --</option>
            @foreach($jadwal as $item)
                <option value="{{ $item->id }}">{{ $item->asal }} - {{ $item->tujuan }} - {{ $item->tanggal_berangkat }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Nomor Kursi</label>
        <input type="text" name="nomor_kursi" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-control" required>
            <option value="kosong">Kosong</option>
            <option value="terisi">Terisi</option>
        </select>
    </div>

    <button class="btn btn-primary-custom">Simpan</button>
</form>
@endsection
