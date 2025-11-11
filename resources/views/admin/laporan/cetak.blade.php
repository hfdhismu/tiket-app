<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Pemesanan</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 5px; text-align: left; }
        th { background-color: #f2f2f2; }
        h1 { text-align: center; }
    </style>
</head>
<body>
    <h1>Laporan Pemesanan Tiket</h1>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Customer</th>
                <th>Jadwal</th>
                <th>Kursi</th>
                <th>Jumlah Tiket</th>
                <th>Total Harga</th>
                <th>Status Pemesanan</th>
                <th>Status Pembayaran</th>
                <th>Surat Jalan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pemesanans as $index => $p)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $p->user?->name ?? '-' }}</td>
                <td>
                    {{ $p->jadwal?->asal ?? '-' }} → {{ $p->jadwal?->tujuan ?? '-' }} <br>
                    {{ $p->jadwal?->tanggal_berangkat ?? '-' }} jam {{ $p->jadwal?->jam_berangkat ?? '-' }}
                </td>
                <td>{{ $p->kursi?->nomor_kursi ?? '-' }}</td>
                <td>{{ $p->jumlah_tiket }}</td>
                <td>Rp {{ number_format($p->total_harga, 0, ',', '.') }}</td>
                <td>{{ ucfirst($p->status) }}</td>
                <td>{{ $p->pembayaran?->status ?? 'Belum bayar' }}</td>
                <td>
                    @if($p->suratJalan)
                        {{ $p->suratJalan->nomor ?? '-' }}
                    @else
                        -
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
