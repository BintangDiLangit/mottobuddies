<?php

namespace App\Http\Controllers\Admin\Sparepart;

use App\Http\Controllers\Controller;
use App\Models\PembelianSparepart;
use App\Models\Pengeluaran;
use App\Models\Sparepart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PembelianSparepartController extends Controller
{
    public function index()
    {
        $spareparts = Sparepart::all();
        $pembelianSpareparts = PembelianSparepart::with('sparepart')->orderBy('created_at', 'DESC')->get();
        return view('admin.sparepart.pembelian-sparepart', compact('spareparts', 'pembelianSpareparts'));
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'sparepart_id' => 'required|numeric',
            'jumlah' => 'required|numeric',
            'total' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('errors', $validator->errors());
        }
        try {
            $sparepart = Sparepart::find($request->sparepart_id);
            DB::beginTransaction();
            PembelianSparepart::create([
                'sparepart_id' => $request->sparepart_id,
                'jumlah' => $request->jumlah,
                'total' => $request->total,
            ]);

            Sparepart::find($request->sparepart_id)->update([
                'stok' =>  $sparepart->stok + $request->jumlah,
            ]);

            Pengeluaran::create([
                'judul_transaksi_pengeluaran' => 'Re-Stock ' . $sparepart->nama_sparepart,
                'total_biaya' => $request->total,
                'jumlah' => $request->jumlah,
                'tanggal' => now(),
            ]);
            DB::commit();
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return redirect()->back();
        }
    }

    public function update(Request $request, $id)
    {
        PembelianSparepart::find($id)->update([
            'jenis_kendaraan' => $request->jenis_kendaraan,
            'nama_tipe_kendaraan' => $request->nama_tipe_kendaraan,
        ]);
        return redirect()->back();
    }

    public function destroy($id)
    {
        PembelianSparepart::find($id)->delete();
        return redirect()->back();
    }
}