<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembelianSparepart extends Model
{
    use HasFactory;
    protected $fillable = [
        'sparepart_id',
        'jumlah',
        'total'
    ];

    public function sparepart()
    {
        return $this->belongsTo(Sparepart::class, 'sparepart_id');
    }
}