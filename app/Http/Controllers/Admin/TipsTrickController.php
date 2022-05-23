<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TipeKendaraan;
use App\Models\TipsTrik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TipsTrickController extends Controller
{
    private $baseurl = 'http://127.0.0.1:8000';
    public function index()
    {
        $tips = TipsTrik::with('tipeKendaraan')->orderBy('updated_at', 'DESC')->get();
        $tipeKendaraans = TipeKendaraan::all();
        return view('admin.tipstrik.index', compact('tips', 'tipeKendaraans'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tipe_kendaraan_id' => 'required|numeric',
            'gambar' => 'required|image|mimes:png,jpg,jpeg',
            'judul' => 'required|string',
            'isi' => 'required|string'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('errors', $validator->errors());
        }
        if ($request->hasFile('gambar')) {
            $fileNameGambarSparepart = 'gambar_tipstrik_' . uniqid() . strtolower(Str::random(10)) . '.' . $request->gambar->extension();
            $request->file('gambar')->move('storage/gambar-tips-trik/', $fileNameGambarSparepart);
            TipsTrik::create([
                'tipe_kendaraan_id' => $request->tipe_kendaraan_id,
                'judul' => $request->judul,
                'isi' => $request->isi,
                'gambar' => $this->baseurl . '/storage/gambar-tips-trik/' . $fileNameGambarSparepart
            ]);
        }

        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'gambar' => 'nullable|image|mimes:png,jpg,jpeg',
            'judul' => 'required|string',
            'isi' => 'required|string'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('errors', $validator->errors());
        }
        TipsTrik::find($id)->update([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'tipe_kendaraan_id' => $request->tipe_kendaraan_id,
        ]);

        if ($request->hasFile('gambar')) {
            $fileNameGambarSparepart = 'gambar_tipstrik_' . uniqid() . strtolower(Str::random(10)) . '.' . $request->gambar->extension();
            $request->file('gambar')->move('storage/gambar-tips-trik/', $fileNameGambarSparepart);
            TipsTrik::find($id)->update([
                'gambar' => $this->baseurl . '/storage/gambar-tips-trik/' . $fileNameGambarSparepart
            ]);
        }
        return redirect()->back();
    }

    public function destroy($id)
    {
        TipsTrik::find($id)->delete();
        return redirect()->back();
    }
}