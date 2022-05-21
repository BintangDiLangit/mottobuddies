<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'booking_id',
        'total_invoice',
        'bukti_bayar',
        'is_verified',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }
    public function spareparts()
    {
        return $this->belongsToMany(Sparepart::class, 'sparepart_invoice')->withPivot('amount')->withTimestamps();
    }
}