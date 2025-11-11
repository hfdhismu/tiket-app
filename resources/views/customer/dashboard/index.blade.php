@extends('layouts.customer')

@section('title', 'Dashboard Customer')

@section('customer-content')
<div class="container-fluid py-4">

    <h2 class="mb-4 fw-semibold text-primary-custom">Dashboard</h2>

    {{-- ===== Ringkasan Card ===== --}}
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-4 h-100 card-hover">
                <div class="card-body">
                    <h6 class="text-muted mb-2">Total Pemesanan</h6>
                    <h3 class="fw-bold text-primary-custom mb-0">{{ $totalPemesanan ?? 0 }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-4 h-100 card-hover">
                <div class="card-body">
                    <h6 class="text-muted mb-2">Total Pemesanan Terbayar</h6>
                    <h3 class="fw-bold text-primary-custom mb-0">{{ $totalPembayaran ?? 0 }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-4 h-100 card-hover">
                <div class="card-body">
                    <h6 class="text-muted mb-2">Total Riwayat Pemesanan</h6>
                    <h3 class="fw-bold text-primary-custom mb-0">{{ $totalRiwayat ?? 0 }}</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- ===== Filter Jadwal ===== --}}
    <div class="card shadow-sm border-0 rounded-4 mb-4">
        <div class="card-body">
            <h5 class="fw-semibold mb-3 text-primary-custom">Cari Jadwal Keberangkatan</h5>
            <form method="GET" action="{{ route('customer.dashboard') }}" class="row g-3 align-items-center">
                <div class="col-md-5">
                    <input type="text" name="asal" value="{{ request('asal') }}" class="form-control"
                        placeholder="Cari Asal Keberangkatan">
                </div>
                <div class="col-md-5">
                    <input type="text" name="tujuan" value="{{ request('tujuan') }}" class="form-control"
                        placeholder="Cari Tujuan Keberangkatan">
                </div>
                <div class="col-md-2 d-grid">
                    <button type="submit" class="btn btn-primary-custom fw-semibold">Filter</button>
                </div>
            </form>
        </div>
    </div>

    {{-- ===== Daftar Jadwal Aktif ===== --}}
    <div class="card shadow-sm border-0 rounded-4 mb-5">
        <div class="card-body">
            <h5 class="fw-semibold mb-3 text-primary-custom">Daftar Jadwal Aktif</h5>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Kode Jadwal</th>
                            <th>Asal</th>
                            <th>Tujuan</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>Harga</th>
                            <th>Sisa Kursi</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($jadwals as $jadwal)
                            <tr>
                                <td class="fw-semibold">{{ $jadwal->kode_jadwal }}</td>
                                <td>{{ $jadwal->asal }}</td>
                                <td>{{ $jadwal->tujuan }}</td>
                                <td>{{ \Carbon\Carbon::parse($jadwal->tanggal_berangkat)->format('d M Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($jadwal->jam_berangkat)->format('H:i') }}</td>
                                <td>Rp {{ number_format($jadwal->harga, 0, ',', '.') }}</td>
                                <td>{{ $jadwal->sisa_kursi }}</td>
                                <td>
                                    <span class="badge bg-success-subtle text-success text-capitalize">
                                        {{ $jadwal->status }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('customer.pemesanan.create', ['jadwal_id' => $jadwal->id]) }}" class="btn btn-sm btn-primary-custom rounded-pill fw-semibold px-3">
                                        <i class="fas fa-ticket-alt me-1"></i> Pesan
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted py-4">
                                    Tidak ada jadwal aktif yang ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- ===== Chart Section ===== --}}
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body">
            <h5 class="fw-semibold mb-3 text-primary-custom">Grafik Pemesanan 6 Bulan Terakhir</h5>
            <canvas id="chartPemesanan" height="120"></canvas>
        </div>
    </div>

</div>

{{-- ===== Custom Style ===== --}}
<style>
.card-hover {
    transition: all 0.25s ease;
}
.card-hover:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
}
.bg-success-subtle {
    background-color: #e8f6ec !important;
}
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
</style>

{{-- ===== Chart.js CDN & Script ===== --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('chartPemesanan');
new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober'],
        datasets: [{
            label: 'Total Pemesanan',
            data: [10, 18, 25, 20, 30, 27], // dummy data, nanti bisa diganti dari controller
            borderColor: '#007bff',
            backgroundColor: 'rgba(0, 123, 255, 0.1)',
            tension: 0.3,
            borderWidth: 2,
            fill: true,
            pointRadius: 4,
            pointBackgroundColor: '#007bff'
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { display: false },
            tooltip: { enabled: true }
        },
        scales: {
            y: { beginAtZero: true, ticks: { precision: 0 } }
        }
    }
});
</script>
@endsection
