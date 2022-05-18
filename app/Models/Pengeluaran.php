<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    use HasFactory;
    protected $fillable = [
        'judul_transaksi_pengeluaran',
        'total_biaya',
        'jumlah',
        'tanggal'
    ];
}