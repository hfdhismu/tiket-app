<?php

namespace App\Http\Controllers\Checker;

use App\Http\Controllers\Controller;
use App\Models\Pemesanan;

class CheckInController extends Controller
{
    public function checkIn($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);

        // Cek status pembayaran dulu
        if ($pemesanan->status !== 'dibayar') {
            return back()->with('error', 'Penumpang belum membayar, tidak bisa check-in.');
        }

        // Update check-in
        $pemesanan->update(['check_in' => true]);

        $customerName = $pemesanan->user->name ?? 'Unknown';
        return back()->with('success', 'Penumpang "' . $customerName . '" berhasil check-in.');
    }
}
