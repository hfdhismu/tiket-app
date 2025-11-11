<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratJalan extends Model
{
    use HasFactory;

    protected $table = 'surat_jalans';
    protected $fillable = [
        'jadwal_id',
        'nomor_surat',
        'tanggal_cetak',
        'checker',
        'status',
        'pemesanan_id'
    ];

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class);
    }

    public function pemesanans()
    {
        // Satu surat jalan terkait jadwal, ambil semua pemesanan di jadwal itu
        return $this->hasMany(Pemesanan::class, 'jadwal_id', 'jadwal_id');
    }

}
