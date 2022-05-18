<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipeKendaraan extends Model
{
    use HasFactory;
    protected $fillable = [
        'jenis_kendaraan',
        'nama_tipe_kendaraan'
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}