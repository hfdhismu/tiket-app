<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index()
    {
        // Ambil semua pemesanan beserta relasinya
        $pemesanans = Pemesanan::with(['user', 'jadwal', 'kursi', 'pembayaran', 'suratJalan'])
            ->latest()
            ->get();

        return view('admin.laporan.index', compact('pemesanans'));
    }

    public function show($id)
    {
        $pemesanan = Pemesanan::with(['user', 'jadwal', 'kursi', 'pembayaran', 'suratJalan'])
            ->findOrFail($id);

        return view('admin.laporan.show', compact('pemesanan'));
    }

    public function cetak()
    {
        $pemesanans = Pemesanan::with(['user', 'jadwal', 'kursi', 'pembayaran', 'suratJalan'])->get();

        $pdf = Pdf::loadView('admin.laporan.cetak', compact('pemesanans'));

        return $pdf->download('laporan_pemesanan.pdf');
    }
}
