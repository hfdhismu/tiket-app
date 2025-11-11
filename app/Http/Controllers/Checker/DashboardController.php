<?php

namespace App\Http\Controllers\Checker;

use App\Http\Controllers\Controller;
use App\Models\CheckIn;
use App\Models\SuratJalan;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCheckIn = CheckIn::count();
        $hariIni = CheckIn::whereDate('created_at', Carbon::today())->count();
        $totalSuratJalan = SuratJalan::count();

        return view('checker.dashboard.index', compact('totalCheckIn', 'hariIni', 'totalSuratJalan'));
    }
}
