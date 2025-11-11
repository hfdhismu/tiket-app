<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Jalan - {{ $suratJalan->nomor_surat }}</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        h2 { text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background-color: #f2f2f2; }
        .text-center { text-align: center; }
        .mt-2 { margin-top: 10px; }
        .mt-4 { margin-top: 20px; }
    </style>
</head>
<body>
    <h2>SURAT JALAN</h2>

    <p><strong>Nomor Surat:</strong> {{ $suratJalan->nomor_surat }}</p>
    <p><strong>Checker:</strong> {{ $suratJalan->checker }}</p>
    <p><strong>Rute:</strong> {{ $suratJalan->jadwal->asal }} → {{ $suratJalan->jadwal->tujuan }}</p>
    <p><strong>Tanggal Keberangkatan:</strong>
        {{ \Carbon\Carbon::parse($suratJalan->jadwal->tanggal_berangkat)->format('d M Y') }}
    </p>

    <h4 class="mt-4">Daftar Penumpang</h4>
    <table>
        <thead>
            <tr>
                <th style="width:5%">No</th>
                <th>Nama Penumpang</th>
                <th style="width:25%">Status Check-In</th>
            </tr>
        </thead>
        <tbody>
            @foreach($suratJalan->pemesanans as $i => $p)
                <tr>
                    <td class="text-center">{{ $i + 1 }}</td>
                    <td>{{ $p->user->name ?? '-' }}</td>
                    <td>{{ $p->check_in ? 'Sudah' : 'Belum' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p class="mt-4 text-center">Dicetak pada {{ \Carbon\Carbon::now()->format('d M Y H:i') }}</p>
</body>
</html>
