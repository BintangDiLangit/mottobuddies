<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemasukkan extends Model
{
    use HasFactory;
    protected $fillable = [
        'judul_transaksi_pemasukkan',
        'total_biaya',
        'jumlah',
        'tanggal'
    ];
}