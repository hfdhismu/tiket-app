@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('admin-content')
<div class="container-fluid py-4">

    <h2 class="mb-4 fw-semibold text-maroon">Dashboard Admin</h2>

    {{-- ===== Ringkasan Card ===== --}}
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-4 h-100 card-hover">
                <div class="card-body">
                    <h6 class="text-muted mb-2">Total Jadwal</h6>
                    <h3 class="fw-bold text-maroon mb-0">{{ $totalJadwal ?? 0 }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-4 h-100 card-hover">
                <div class="card-body">
                    <h6 class="text-muted mb-2">Total Pemesanan</h6>
                    <h3 class="fw-bold text-maroon mb-0">{{ $totalPemesanan ?? 0 }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-4 h-100 card-hover">
                <div class="card-body">
                    <h6 class="text-muted mb-2">Total Surat Jalan</h6>
                    <h3 class="fw-bold text-maroon mb-0">{{ $totalSuratJalan ?? 0 }}</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- ===== Chart Pemesanan ===== --}}
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body">
            <h5 class="fw-semibold mb-3 text-maroon">Grafik Pemesanan 6 Bulan Terakhir</h5>
            <canvas id="chartPemesanan" height="120"></canvas>
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

    .btn-maroon {
        background-color: #800000;
        color: white;
        border: none;
        transition: all 0.25s ease;
    }

    .btn-maroon:hover {
        background-color: #5a0000;
        color: white;
    }

    .bg-success-subtle {
        background-color: #f2e8e8 !important;
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
            borderColor: '#800000',
            backgroundColor: 'rgba(128, 0, 0, 0.25)',
            hoverBackgroundColor: 'rgba(128, 0, 0, 0.5)',
            borderWidth: 2,
            borderRadius: 6
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
