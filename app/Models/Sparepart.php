<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sparepart extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_sparepart',
        'harga_beli',
        'harga_jual',
        'gambar_sparepart',
        'satuan',
        'stok'
    ];

    public function spareparts()
    {
        return $this->hasMany(PembelianSparepart::class);
    }
}