<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\SuratJalan;
use App\Models\Jadwal;

class Pemesanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'jadwal_id', 'kursi_id', 'kode_pemesanan',
        'jumlah_tiket', 'total_harga', 'status', 'check_in'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class);
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class);
    }

    public function checkIn()
    {
        return $this->hasOne(CheckIn::class);
    }

    public function kursi()
    {
        return $this->belongsTo(Kursi::class, 'pemesanan_id');
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function suratJalan()
    {
        return $this->hasOneThrough(
            SuratJalan::class,
            Jadwal::class, 
            'id',       
            'jadwal_id',             
            'jadwal_id',               
            'id'   
        );
    }

}
