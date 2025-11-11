@extends('layouts.admin')

@section('title', 'Detail Pemesanan')

@section('admin-content')
<h1 class="mb-4 text-primary-custom">Detail Pemesanan</h1>

<table class="table table-bordered">
    <tr>
        <th>Customer</th>
        <td>{{ $pemesanan->user?->name ?? '-' }}</td>
    </tr>
    <tr>
        <th>Jadwal</th>
        <td>{{ $pemesanan->jadwal?->asal ?? '-' }} → {{ $pemesanan->jadwal?->tujuan ?? '-' }}</td>
    </tr>
    <tr>
        <th>Kursi</th>
        <td>{{ $pemesanan->kursi?->nomor_kursi ?? '-' }}</td>
    </tr>
    <tr>
        <th>Jumlah Tiket</th>
        <td>{{ $pemesanan->jumlah_tiket }}</td>
    </tr>
    <tr>
        <th>Total Harga</th>
        <td>Rp {{ number_format($pemesanan->total_harga, 0, ',', '.') }}</td>
    </tr>
    <tr>
        <th>Status Pemesanan</th>
        <td>{{ ucfirst($pemesanan->status) }}</td>
    </tr>
    <tr>
        <th>Status Pembayaran</th>
        <td>{{ $pemesanan->pembayaran?->status ?? 'Belum bayar' }}</td>
    </tr>
    <tr>
        <th>Surat Jalan</th>
        <td>
            @if($pemesanan->suratJalan)
                <a href="{{ route('admin.surat-jalan.show', $pemesanan->suratJalan->id) }}" target="_blank">Lihat</a>
            @else
                -
            @endif
        </td>
    </tr>
</table>
@endsection
