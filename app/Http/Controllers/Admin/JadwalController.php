<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\SuratJalan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JadwalController extends Controller
{
    public function index()
    {
        $jadwals = Jadwal::withCount([
            'kursis as sisa_kursi' => function ($query) {
                $query->where('status', 'kosong');
            }
        ])->get();

        return view('admin.jadwal.index', compact('jadwals'));
    }

    public function create()
    {
        return view('admin.jadwal.create');
    }

    public function store(Request $request)
    {
        // 1️⃣ Validasi input
        $request->validate([
            'asal' => 'required|string|max:255',
            'tujuan' => 'required|string|max:255',
            'tanggal_berangkat' => 'required|date|after_or_equal:today',
            'jam_berangkat' => 'required',
            'jumlah_kursi' => 'required|integer|min:1',
            'harga' => 'required|numeric|min:0',
        ]);

        // 2️⃣ Buat jadwal
        $jadwal = Jadwal::create([
            'kode_jadwal' => 'AAA' . time(),
            'asal' => $request->asal,
            'tujuan' => $request->tujuan,
            'tanggal_berangkat' => $request->tanggal_berangkat,
            'jam_berangkat' => $request->jam_berangkat,
            'jumlah_kursi' => $request->jumlah_kursi,
            'harga' => $request->harga,
        ]);

        // 3️⃣ Generate kursi
        $this->generateKursi($jadwal);

        // 4️⃣ Buat Surat Jalan draft otomatis
        SuratJalan::create([
                'jadwal_id' => $jadwal->id,
                'nomor_surat' => 'NS-' . date('Ymd') . '-' . strtoupper(substr(md5(time()), 0, 4)),
                'status' => 'draft',
                'tanggal_cetak' => now()->format('Y-m-d'), // wajib jika kolom NOT NULL
                'checker' => 'Admin',                       // wajib jika kolom NOT NULL
        ]);

        // 5️⃣ Redirect dengan pesan sukses
        return redirect()->route('admin.jadwal.index')
                         ->with('success', 'Jadwal, kursi, dan surat jalan berhasil dibuat.');
    }


    public function edit($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        return view('admin.jadwal.edit', compact('jadwal'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'asal' => 'required|string|max:255',
            'tujuan' => 'required|string|max:255',
            'tanggal_berangkat' => 'required|date',
            'jam_berangkat' => 'required',
            'jumlah_kursi' => 'required|integer|min:1',
            'harga' => 'required|numeric|min:0',
        ]);

        $jadwal = Jadwal::findOrFail($id);
        $jadwal->update([
            'asal' => $request->asal,
            'tujuan' => $request->tujuan,
            'tanggal_berangkat' => $request->tanggal_berangkat,
            'jam_berangkat' => $request->jam_berangkat,
            'jumlah_kursi' => $request->jumlah_kursi,
            'harga' => $request->harga,
        ]);

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Jadwal::destroy($id);
        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil dihapus.');
    }

    private function generateKursi($jadwal)
    {
        $jumlah = $jadwal->jumlah_kursi; // ambil jumlah kursi dari jadwal
        $kursiList = [];

        for ($i = 1; $i <= $jumlah; $i++) {
            // contoh nomor kursi: A1, A2, ...
            $kursiList[] = [
                'jadwal_id' => $jadwal->id,
                'nomor_kursi' => 'A'.$i,
                'status' => 'kosong',
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        DB::table('kursis')->insert($kursiList);
    }

}
