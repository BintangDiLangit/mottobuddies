<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PembayaranController extends Controller
{
    private $baseurl = 'http://127.0.0.1:8000';
    public function update(Request $request, $id)
    {


        $validator = Validator::make($request->all(), [
            'bukti_bayar' => 'required|image|mimes:png,jpg,jpeg',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('errors', $validator->errors());
        }
        $invoice = Invoice::find($id);
        try {
            if ($invoice != null && $request->hasFile('bukti_bayar')) {
                DB::beginTransaction();
                $fileNameBuktiBayar = 'bukti_bayar_' . uniqid() . strtolower(Str::random(10)) . '.' . $request->bukti_bayar->extension();
                $request->file('bukti_bayar')->move('storage/bukti-pembayaran/', $fileNameBuktiBayar);
                $invoice->forceFill([
                    'bukti_bayar' => $this->baseurl . '/storage/bukti-pembayaran/' . $fileNameBuktiBayar,
                ])->save();
                DB::commit();
                return redirect()->back()->with('success');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return redirect()->back()->with('errors', 'Gagal mengirim bukti bayar');
        }
    }
}