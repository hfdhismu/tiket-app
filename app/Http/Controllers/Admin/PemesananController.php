<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pemesanan;
use App\Models\Pembayaran;
use App\Models\Jadwal;
use App\Models\User;
use Illuminate\Http\Request;

class PemesananController extends Controller
{
    public function index()
    {
        $pemesanan = Pemesanan::with(['jadwal', 'user'])->latest()->get();
        return view('admin.pemesanan.index', compact('pemesanan'));
    }

    public function show($id)
    {
        $pemesanan = Pemesanan::with(['jadwal', 'user'])->findOrFail($id);
        return view('admin.pemesanan.show', compact('pemesanan'));
    }

    public function destroy($id)
    {
        Pemesanan::destroy($id);
        return redirect()->route('admin.pemesanan.index')->with('success', 'Pemesanan berhasil dihapus');
    }

    public function konfirmasi($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->update(['status' => 'valid']);

        // Optional: update status pemesanan juga
        $pembayaran->pemesanan->update(['status' => 'dibayar']);

        return redirect()->back()->with('success', 'Pembayaran berhasil dikonfirmasi.');
    }

}
