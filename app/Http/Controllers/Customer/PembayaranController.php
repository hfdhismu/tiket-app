<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Pemesanan;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    // Tampilkan daftar pemesanan & pembayaran
    public function index()
    {
        $pemesanans = Pemesanan::with('pembayaran', 'jadwal')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('customer.pembayaran.index', compact('pemesanans'));
    }

    // Form upload bukti pembayaran
    public function create(Pemesanan $pemesanan)
    {
        // Cek apakah sudah ada pembayaran
        if ($pemesanan->pembayaran) {
            return redirect()->route('customer.pembayaran.index')
                ->with('error', 'Pembayaran untuk pesanan ini sudah ada.');
        }

        return view('customer.pembayaran.create', compact('pemesanan'));
    }

    // Store bukti pembayaran
    public function store(Request $request)
    {
        $request->validate([
            'pemesanan_id' => 'required|exists:pemesanans,id',
            'bukti_transfer' => 'required|image|max:5120',
        ]);

        $pemesanan = Pemesanan::findOrFail($request->pemesanan_id);

        // Simpan file ke storage/public/bukti-transfer
        $path = $request->file('bukti_transfer')->store('bukti-transfer', 'public');

        Pembayaran::create([
            'pemesanan_id' => $pemesanan->id,
            'bukti_pembayaran' => $path,
            'status' => 'menunggu', // status pembayaran
        ]);

        // **Update status pemesanan**
        $pemesanan->update([
            'status' => 'pending',
        ]);

        return redirect()->route('customer.pembayaran.index')
            ->with('success', 'Bukti pembayaran berhasil diupload.');
    }
}
