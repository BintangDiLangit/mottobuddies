<?php

namespace App\Http\Controllers\Admin\DataKeuangan;

use App\Http\Controllers\Controller;
use App\Models\Pemasukkan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PemasukkanController extends Controller
{
    public function index()
    {
        $pemasukkans = Pemasukkan::orderBy('updated_at', 'desc')->get();
        return view('admin.datakeuangan.pemasukkan', compact('pemasukkans'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul_transaksi_pemasukkan' => 'required|string',
            'total_biaya' => 'required|numeric',
            'jumlah' => 'required|numeric',
            'tanggal' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('errors', $validator->errors());
        }
        $tanggal = date('H:i:s', strtotime(Carbon::now()));
        $tanggalFix = $request->tanggal . ' ' . $tanggal;
        Pemasukkan::create([
            'judul_transaksi_pemasukkan' => $request->judul_transaksi_pemasukkan,
            'total_biaya' => $request->total_biaya,
            'jumlah' => $request->jumlah,
            'tanggal' => $tanggalFix,
        ]);
        return redirect()->back();
    }
}