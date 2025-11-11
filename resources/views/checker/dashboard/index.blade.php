@extends('layouts.checker')

@section('title', 'Dashboard Checker')

@section('checker-content')
<div class="container-fluid py-4">
    <h2 class="mb-4 fw-semibold text-primary-custom">Dashboard Checker</h2>

    {{-- ===== Ringkasan Card ===== --}}
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-4 h-100 card-hover text-center">
                <div class="card-body py-4">
                    <h6 class="text-muted mb-2">Total Penumpang Diperiksa</h6>
                    <h3 class="fw-bold text-primary-custom mb-0">{{ $totalCheckIn }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-4 h-100 card-hover text-center">
                <div class="card-body py-4">
                    <h6 class="text-muted mb-2">Pemeriksaan Hari Ini</h6>
                    <h3 class="fw-bold text-primary-custom mb-0">{{ $hariIni }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-4 h-100 card-hover text-center">
                <div class="card-body py-4">
                    <h6 class="text-muted mb-2">Total Surat Jalan Aktif</h6>
                    <h3 class="fw-bold text-primary-custom mb-0">{{ $totalSuratJalan }}</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- ===== Grafik Aktivitas ===== --}}
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body">
            <h5 class="fw-semibold mb-3 text-primary-custom">Aktivitas Pemeriksaan Mingguan</h5>
            <canvas id="checkInChart" height="120"></canvas>
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
.text-primary-custom {
    color: #007bff;
}
</style>

{{-- ===== Chart.js ===== --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('checkInChart');
new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
        datasets: [{
            label: 'Jumlah Check-In',
            data: [5, 8, 6, 7, 9, 4, 6], // contoh dummy data
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
            legend: { display: false }
        },
        scales: {
            y: { beginAtZero: true, ticks: { precision: 0 } }
        }
    }
});
</script>
@endsection
