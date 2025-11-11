<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kursi extends Model
{
    use HasFactory;

    protected $fillable = ['jadwal_id', 'nomor_kursi', 'status', 'pemesanan_id',];

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class);
    }

    public function pemesanan()
    {
        return $this->hasOne(Pemesanan::class);
    }
}
