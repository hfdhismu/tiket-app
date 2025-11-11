<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Pemesanan;
use App\Models\Pembayaran;
use App\Models\Jadwal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id();

        // Hitung total ringkasan
        $totalPemesanan = Pemesanan::where('user_id', $userId)->count();
        $totalPembayaran = Pembayaran::whereHas('pemesanan', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })->count();
        $totalRiwayat = Pemesanan::where('user_id', $userId)
            ->whereIn('status', ['dibayar', 'batal'])
            ->count();

        // === Query jadwal dengan filter ===
        $query = Jadwal::where('status', 'aktif');

        if ($request->filled('asal')) {
            $query->where('asal', 'like', '%' . $request->asal . '%');
        }

        if ($request->filled('tujuan')) {
            $query->where('tujuan', 'like', '%' . $request->tujuan . '%');
        }

        // Tambahkan hitung sisa kursi
        $jadwals = $query->withCount(['kursis as sisa_kursi' => function ($q) {
            $q->where('status', 'kosong');
        }])
        ->having('sisa_kursi', '>', 0) // hanya jadwal dengan kursi tersisa
        ->get();

        // Kirim ke view
        return view('customer.dashboard.index', compact(
            'totalPemesanan',
            'totalPembayaran',
            'totalRiwayat',
            'jadwals'
        ));
    }
}
