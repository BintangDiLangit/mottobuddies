<?php

namespace App\Http\Controllers\Admin\DataKeuangan;

use App\Http\Controllers\Controller;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
{
    public function index()
    {
        $pengeluarans = Pengeluaran::orderBy('updated_at', 'desc')->get();
        return view('admin.datakeuangan.pengeluaran', compact('pengeluarans'));
    }
}