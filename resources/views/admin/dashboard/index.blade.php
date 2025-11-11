@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('admin-content')
<div class="container-fluid py-4">

    <h2 class="mb-4 fw-semibold text-primary-custom">Dashboard Admin</h2>

    {{-- ===== Ringkasan Card ===== --}}
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-4 h-100 card-hover">
                <div class="card-body">
                    <h6 class="text-muted mb-2">Total Jadwal</h6>
                    <h3 class="fw-bold text-primary-custom mb-0">{{ $totalJadwal ?? 0 }}</h3>
                </div>
            </div>
        </div>
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
                    <h6 class="text-muted mb-2">Total Surat Jalan</h6>
                    <h3 class="fw-bold text-primary-custom mb-0">{{ $totalSuratJalan ?? 0 }}</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- ===== Chart Pemesanan ===== --}}
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
</style>

{{-- ===== Chart.js Script ===== --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('chartPemesanan');
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: @json($chartLabels),
        datasets: [{
            label: 'Total Pemesanan',
            data: @json($chartData),
            borderColor: '#007bff',
            backgroundColor: 'rgba(0, 123, 255, 0.2)',
            borderWidth: 2,
            borderRadius: 6
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
