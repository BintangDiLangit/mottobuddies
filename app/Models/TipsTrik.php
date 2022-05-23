<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipsTrik extends Model
{
    use HasFactory;
    protected $fillable = [
        'tipe_kendaraan_id',
        'judul',
        'gambar',
        'isi'
    ];
    public function tipeKendaraan()
    {
        return $this->belongsTo(TipeKendaraan::class, 'tipe_kendaraan_id');
    }
}