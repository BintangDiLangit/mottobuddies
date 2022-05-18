<?php

namespace App\Http\Controllers\Admin\DataKeuangan;

use App\Http\Controllers\Controller;
use App\Models\Pemasukkan;
use Illuminate\Http\Request;

class PemasukkanController extends Controller
{
    public function index()
    {
        $pemasukkans = Pemasukkan::orderBy('updated_at', 'desc')->get();
        return view('admin.datakeuangan.pemasukkan', compact('pemasukkans'));
    }
}