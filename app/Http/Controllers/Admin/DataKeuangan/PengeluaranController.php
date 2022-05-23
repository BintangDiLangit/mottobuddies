<?php

namespace App\Http\Controllers\Admin\DataKeuangan;

use App\Http\Controllers\Controller;
use App\Models\Pengeluaran;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PengeluaranController extends Controller
{
    public function index()
    {
        $pengeluarans = Pengeluaran::orderBy('updated_at', 'desc')->get();
        return view('admin.datakeuangan.pengeluaran', compact('pengeluarans'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul_transaksi_pengeluaran' => 'required|string',
            'total_biaya' => 'required|numeric',
            'jumlah' => 'required|numeric',
            'tanggal' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('errors', $validator->errors());
        }
        $tanggal = date('H:i:s', strtotime(Carbon::now()));
        $tanggalFix = $request->tanggal . ' ' . $tanggal;
        Pengeluaran::create([
            'judul_transaksi_pengeluaran' => $request->judul_transaksi_pengeluaran,
            'total_biaya' => $request->total_biaya,
            'jumlah' => $request->jumlah,
            'tanggal' => $tanggalFix,
        ]);
        return redirect()->back();
    }
}