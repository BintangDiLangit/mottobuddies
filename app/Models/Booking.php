<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'tipe_kendaraan_id',
        'waktu_booking'
    ];

    public function tipeKendaraan()
    {
        return $this->belongsTo(TipeKendaraan::class, 'tipe_kendaraan_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }
}