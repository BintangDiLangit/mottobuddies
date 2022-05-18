<?php

namespace App\Http\Controllers\Admin\Sparepart;

use App\Http\Controllers\Controller;
use App\Models\Sparepart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class SparepartController extends Controller
{
    private $baseurl = 'http://127.0.0.1:8000';
    public function index()
    {
        $spareparts = Sparepart::all();
        return view('admin.sparepart.sparepart', compact('spareparts'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'gambar_sparepart' => 'required|image|mimes:png,jpg,jpeg',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'satuan' => 'required|string',
            'nama_sparepart' => 'required|string',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('errors', $validator->errors());
        }
        if ($request->hasFile('gambar_sparepart')) {
            $fileNameGambarSparepart = 'gambar_sparepart_' . uniqid() . strtolower(Str::random(10)) . '.' . $request->gambar_sparepart->extension();
            $request->file('gambar_sparepart')->move('storage/gambar-sparepart/', $fileNameGambarSparepart);

            Sparepart::create([
                'nama_sparepart' => $request->nama_sparepart,
                'harga_beli' => $request->harga_beli,
                'harga_jual' => $request->harga_jual,
                'gambar_sparepart' => $this->baseurl . '/storage/gambar-sparepart/' . $fileNameGambarSparepart,
                'satuan' => $request->satuan,
            ]);
            return redirect()->back();
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'gambar_sparepart' => 'nullable|image|mimes:png,jpg,jpeg',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'satuan' => 'required|string',
            'nama_sparepart' => 'required|string',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('errors', $validator->errors());
        }
        Sparepart::find($id)->update([
            'nama_sparepart' => $request->nama_sparepart,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'satuan' => $request->satuan,
        ]);

        if ($request->hasFile('gambar_sparepart')) {
            $fileNameGambarSparepart = 'gambar_sparepart_' . uniqid() . strtolower(Str::random(10)) . '.' . $request->gambar_sparepart->extension();
            $request->file('gambar_sparepart')->move('storage/gambar-sparepart/', $fileNameGambarSparepart);

            Sparepart::find($id)->forceFill([
                'gambar_sparepart' => $this->baseurl . '/storage/gambar-sparepart/' . $fileNameGambarSparepart,
            ])->save();
        }
        return redirect()->back();
    }

    public function destroy($id)
    {
        Sparepart::find($id)->delete();
        return redirect()->back();
    }
}