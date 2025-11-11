<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kursi;
use App\Models\Jadwal;
use Illuminate\Http\Request;

class KursiController extends Controller
{
    public function index()
    {
        $kursi = Kursi::with('jadwal')->get();
        return view('admin.kursi.index', compact('kursi'));
    }

    public function create()
    {
        $jadwal = Jadwal::all();
        return view('admin.kursi.create', compact('jadwal'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jadwal_id' => 'required|exists:jadwals,id',
            'nomor_kursi' => 'required|string',
            'status' => 'required|in:kosong,terisi',
        ]);

        Kursi::create($request->all());
        return redirect()->route('admin.kursi.index')->with('success', 'Kursi berhasil ditambahkan');
    }

    public function edit($id)
    {
        $kursi = Kursi::findOrFail($id);
        $jadwal = Jadwal::all();
        return view('admin.kursi.edit', compact('kursi', 'jadwal'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jadwal_id' => 'required|exists:jadwals,id',
            'nomor_kursi' => 'required|string',
            'status' => 'required|in:kosong,terisi',
        ]);

        $kursi = Kursi::findOrFail($id);
        $kursi->update($request->all());
        return redirect()->route('admin.kursi.index')->with('success', 'Kursi berhasil diperbarui');
    }

    public function destroy($id)
    {
        Kursi::destroy($id);
        return redirect()->route('admin.kursi.index')->with('success', 'Kursi berhasil dihapus');
    }
}
