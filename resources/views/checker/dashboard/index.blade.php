@extends('layouts.checker')

@section('title', 'Dashboard Checker')

@section('checker-content')
<div class="container-fluid py-4">

    <h2 class="mb-4 fw-semibold text-maroon">Dashboard Checker</h2>

    {{-- ===== Ringkasan Card ===== --}}
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-4 h-100 card-hover text-center">
                <div class="card-body py-4">
                    <h6 class="text-muted mb-2">Total Penumpang Diperiksa</h6>
                    <h3 class="fw-bold text-maroon mb-0">{{ $totalCheckIn ?? 120 }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-4 h-100 card-hover text-center">
                <div class="card-body py-4">
                    <h6 class="text-muted mb-2">Pemeriksaan Hari Ini</h6>
                    <h3 class="fw-bold text-maroon mb-0">{{ $hariIni ?? 15 }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-4 h-100 card-hover text-center">
                <div class="card-body py-4">
                    <h6 class="text-muted mb-2">Total Surat Jalan Aktif</h6>
                    <h3 class="fw-bold text-maroon mb-0">{{ $totalSuratJalan ?? 8 }}</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- ===== Grafik Aktivitas ===== --}}
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body">
            <h5 class="fw-semibold mb-3 text-maroon">Aktivitas Pemeriksaan Mingguan</h5>
            <canvas id="checkInChart" height="120"></canvas>
        </div>
    </div>

</div>

{{-- ===== Custom Style ===== --}}
<style>
.text-maroon {
    color: #800000 !important;
}

.card-hover {
    transition: all 0.25s ease;
    border-top: 3px solid transparent;
}

.card-hover:hover {
    transform: translateY(-6px);
    box-shadow: 0 6px 20px rgba(128, 0, 0, 0.2);
    border-top: 3px solid #800000;
}

/* Tambahan biar seragam dengan dashboard admin */
.card {
    border: 1px solid #d8c0c0;
}

h2.fw-semibold {
    font-weight: 600;
    color: #800000;
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
            data: [12, 15, 10, 18, 14, 20, 9], // ← dummy data
            borderColor: '#800000',
            backgroundColor: 'rgba(128, 0, 0, 0.25)',
            hoverBackgroundColor: 'rgba(128, 0, 0, 0.5)',
            tension: 0.3,
            borderWidth: 2,
            fill: true,
            pointRadius: 4,
            pointBackgroundColor: '#800000'
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { display: false },
            tooltip: {
                enabled: true,
                backgroundColor: '#800000',
                titleColor: '#fff',
                bodyColor: '#fff'
            }
        },
        scales: {
            y: { 
                beginAtZero: true, 
                ticks: { precision: 0, color: '#800000', font: { weight: '600' } },
                grid: { color: 'rgba(128,0,0,0.1)' }
            },
            x: {
                ticks: { color: '#800000', font: { weight: '600' } },
                grid: { color: 'rgba(128,0,0,0.05)' }
            }
        }
    }
});
</script>
@endsection
