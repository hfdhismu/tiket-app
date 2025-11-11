<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\Pemesanan;
use App\Models\SuratJalan;

class DashboardController extends Controller
{
    public function index()
    {
        // Ringkasan data
        $totalJadwal = Jadwal::count();
        $totalPemesanan = Pemesanan::count();
        $totalSuratJalan = SuratJalan::count();

        // Data chart (6 bulan terakhir)
        $chartLabels = [];
        $chartData = [];

        $months = collect(range(0, 5))->map(function ($i) {
            return now()->subMonths($i)->format('M');
        })->reverse()->values();

        foreach ($months as $month) {
            $count = Pemesanan::whereMonth('created_at', now()->parse($month)->month)->count();
            $chartLabels[] = $month;
            $chartData[] = $count;
        }

        return view('admin.dashboard.index', compact(
            'totalJadwal',
            'totalPemesanan',
            'totalSuratJalan',
            'chartLabels',
            'chartData'
        ));
    }
}
