<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Pemesanan;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index()
    {
        $pembayaran = Pembayaran::with('pemesanan')->latest()->get();
        return view('admin.pembayaran.index', compact('pembayaran'));
    }

    public function show($id)
    {
        $pembayaran = Pembayaran::with('pemesanan')->findOrFail($id);
        return view('admin.pembayaran.show', compact('pembayaran'));
    }

    public function updateStatus(Request $request, $id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $request->validate(['status' => 'required|in:pending,berhasil,gagal']);
        $pembayaran->update(['status' => $request->status]);

        return redirect()->route('admin.pembayaran.index')->with('success', 'Status pembayaran diperbarui');
    }
}
