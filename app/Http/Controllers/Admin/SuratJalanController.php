<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SuratJalan;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class SuratJalanController extends Controller
{
    public function index()
    {
        $suratJalan = SuratJalan::with(['jadwal', 'pemesanans'])->get();

        // Tambahkan properti bantu (all_checked_in)
        foreach ($suratJalan as $sj) {
            $sj->all_checked_in = $sj->pemesanans->count() > 0
                && $sj->pemesanans->every(fn ($p) => $p->check_in);
        }

        return view('admin.surat-jalan.index', compact('suratJalan'));
    }

    public function create()
    {
        $jadwals = Jadwal::all();
        return view('admin.surat-jalan.create', compact('jadwals'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jadwal_id' => 'required|exists:jadwals,id',
        ]);

        // Buat nomor surat otomatis
        $tanggal = Carbon::now()->format('Ymd');
        $random = strtoupper(Str::random(4));
        $nomorSurat = 'NS-' . $tanggal . '-' . $random;

        // Checker otomatis dari user yang login
        $checker = Auth::user()->name;

        SuratJalan::create([
            'jadwal_id' => $request->jadwal_id,
            'nomor_surat' => $nomorSurat,
            'tanggal_cetak' => Carbon::now()->format('Y-m-d'),
            'checker' => $checker,
        ]);

        return redirect()->route('admin.surat-jalan.index')
            ->with('success', 'Surat Jalan berhasil dibuat dengan nomor: ' . $nomorSurat);
    }

    public function show($id)
    {
        $suratJalan = SuratJalan::with(['jadwal', 'pemesanans.user'])->findOrFail($id);

        // Cek apakah semua penumpang sudah check-in
        $allCheckedIn = $suratJalan->pemesanans->every(fn ($p) => $p->check_in);

        return view('admin.surat-jalan.show', compact('suratJalan', 'allCheckedIn'));
    }

    public function cetak($id)
    {
        $suratJalan = SuratJalan::with(['jadwal', 'pemesanans.user'])->findOrFail($id);

        // Pastikan semua penumpang sudah check in
        $semuaCheckIn = $suratJalan->pemesanans->every(fn ($p) => $p->check_in);

        if (! $semuaCheckIn) {
            return redirect()->back()->with('error', 'Tidak dapat mencetak. Masih ada penumpang yang belum check-in.');
        }

        // Generate PDF dari view
        $pdf = Pdf::loadView('admin.surat-jalan.pdf', compact('suratJalan'))
                  ->setPaper('A4', 'portrait');

        // Langsung tampilkan di browser (bukan download)
        return $pdf->stream('Surat-Jalan-'.$suratJalan->nomor_surat.'.pdf');
    }

}
