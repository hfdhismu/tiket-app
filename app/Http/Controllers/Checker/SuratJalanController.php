<?php

namespace App\Http\Controllers\Checker;

use App\Http\Controllers\Controller;
use App\Models\SuratJalan;

class SuratJalanController extends Controller
{
    public function index()
    {
        // Ambil semua surat jalan beserta jadwal
        $suratJalan = SuratJalan::with('jadwal')->get();

        return view('checker.surat-jalan.index', compact('suratJalan'));
    }

    public function show($id)
    {
        $suratJalan = SuratJalan::with(['jadwal', 'pemesanans.customer'])->findOrFail($id);
        return view('checker.surat-jalan.show', compact('suratJalan'));
    }
}
