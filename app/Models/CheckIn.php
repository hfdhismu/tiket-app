<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckIn extends Model
{
    use HasFactory;

    protected $fillable = ['pemesanan_id', 'kode_checkin', 'waktu_checkin', 'status'];

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class);
    }
}
