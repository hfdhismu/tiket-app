<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = 'jadwals';
    protected $fillable = [
        'kode_jadwal', 'asal', 'tujuan',
        'tanggal_berangkat', 'jam_berangkat',
        'jumlah_kursi', 'harga', 'status'
    ];

    public function kursis()
    {
        return $this->hasMany(Kursi::class);
    }

    public function pemesanans()
    {
        return $this->hasMany(Pemesanan::class);
    }

    public function suratJalan()
    {
        return $this->hasOne(SuratJalan::class);
    }
}
