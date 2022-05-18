<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TipeKendaraan;
use Illuminate\Http\Request;

class TipeKendaraanController extends Controller
{
    public function index()
    {
        $tipeKendaraans = TipeKendaraan::all();
        return view('admin.tipekendaraan.index', compact('tipeKendaraans'));
    }

    public function store(Request $request)
    {
        TipeKendaraan::create([
            'jenis_kendaraan' => $request->jenis_kendaraan,
            'nama_tipe_kendaraan' => $request->nama_tipe_kendaraan,
        ]);

        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        TipeKendaraan::find($id)->update([
            'jenis_kendaraan' => $request->jenis_kendaraan,
            'nama_tipe_kendaraan' => $request->nama_tipe_kendaraan,
        ]);
        return redirect()->back();
    }

    public function destroy($id)
    {
        TipeKendaraan::find($id)->delete();
        return redirect()->back();
    }
}