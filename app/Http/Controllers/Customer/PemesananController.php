<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Pemesanan;
use App\Models\Jadwal;
use App\Models\Kursi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemesananController extends Controller
{
    /**
     * Tampilkan daftar pemesanan customer
     */
    public function index()
    {
        $pemesanan = Pemesanan::with(['jadwal', 'kursi'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('customer.pemesanan.index', compact('pemesanan'));
    }

    /**
     * Form create pemesanan
     */
    public function create(Request $request)
    {
        $jadwal = null;
        $jadwals = [];

        if ($request->has('jadwal_id')) {
            // Jika dari dashboard, ambil jadwal yang dipilih
            $jadwal = Jadwal::findOrFail($request->jadwal_id);
        } else {
            // Jika buka manual dari menu pemesanan
            $jadwals = Jadwal::where('status', 'aktif')->get();
        }

        return view('customer.pemesanan.create', compact('jadwal', 'jadwals'));
    }

    /**
     * Simpan pemesanan baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'jadwal_id' => 'required|exists:jadwals,id',
            'jumlah_tiket' => 'required|integer|min:1',
        ]);

        $jadwal = Jadwal::findOrFail($request->jadwal_id);

        // Ambil kursi kosong sesuai jumlah tiket
        $kursiKosong = Kursi::where('jadwal_id', $jadwal->id)
                            ->where('status', 'kosong')
                            ->take($request->jumlah_tiket)
                            ->get();

        if ($kursiKosong->count() < $request->jumlah_tiket) {
            return back()->with('error', 'Maaf, jumlah kursi yang tersedia tidak cukup.');
        }

        // Buat pemesanan baru
        $pemesanan = Pemesanan::create([
            'user_id' => Auth::id(),
            'jadwal_id' => $jadwal->id,
            'kode_pemesanan' => 'KP-' . strtoupper(uniqid()),
            'jumlah_tiket' => $request->jumlah_tiket,
            'total_harga' => $jadwal->harga * $request->jumlah_tiket,
            'status' => 'belum_bayar', // default saat pemesanan baru
        ]);

        // Update status kursi jadi terisi
        foreach ($kursiKosong as $kursi) {
            $kursi->update(['status' => 'terisi']);
        }

        return redirect()->route('customer.pemesanan.index')
                         ->with('success', 'Pemesanan berhasil dibuat. Silakan upload bukti pembayaran.');
    }

    /**
     * Tampilkan detail pemesanan
     */
    public function show($id)
    {
        $pemesanan = Pemesanan::with(['jadwal', 'kursi'])->findOrFail($id);
        return view('customer.pemesanan.show', compact('pemesanan'));
    }

    /**
     * Hapus pemesanan
     */
    public function destroy(Pemesanan $pemesanan)
    {
        if ($pemesanan->user_id !== Auth::id()) {
            abort(403);
        }

        // Kembalikan status kursi ke kosong
        $kursi = $pemesanan->kursi;
        if ($kursi) {
            $kursi->update(['status' => 'kosong']);
        }

        $pemesanan->delete();

        return redirect()->route('customer.pemesanan.index')
                         ->with('success', 'Pemesanan berhasil dihapus dan kursi dikembalikan.');
    }
}
