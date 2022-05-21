<?php

namespace App\Http\Controllers\Admin\Booking;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Invoice;
use App\Models\Pemasukkan;
use App\Models\Sparepart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class InvoiceController extends Controller
{
    public function index()
    {
        $spareparts = Sparepart::where('stok', '>', 0)->get();
        $bookings = Booking::where('is_complete', 0)->get();

        $invoices = Invoice::with('booking')->orderBy('updated_at', 'desc')->get();
        return view('admin.booking.invoice', compact('invoices', 'spareparts', 'bookings'));
    }

    public function create()
    {
        $spareparts = Sparepart::where('stok', '>', 0)->get();
        $bookings = Booking::where('is_complete', 0)->get();
        return view('admin.booking.create-invoice', compact('spareparts', 'bookings'));
    }
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'booking_id' => 'required|numeric',
            'addMoreInputFieldsSparepart.*.subject' => 'required|string',
            'addMoreInputFieldsAmount.*.amount' => 'required|numeric',
            'biaya_service' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('errors', $validator->errors());
        }

        try {
            $bookingId = $request->booking_id;

            $totalInvoice = 0;
            for ($i = 0; $i < count($request->addMoreInputFieldsSparepart); $i++) {
                $findSpare = Sparepart::where('nama_sparepart', $request->addMoreInputFieldsSparepart[$i])->first();
                $amountSpare = $request->addMoreInputFieldsAmount[$i];
                $totalInvoice += $findSpare->harga_jual * $amountSpare['amount'];
            }

            DB::beginTransaction();

            Invoice::create([
                'booking_id' => $bookingId,
                'total_invoice' => $totalInvoice + $request->biaya_service,
            ]);
            $invoice = Invoice::orderBy('created_at', 'desc')->first();

            $sync_data = [];
            $spareData = [];
            for ($i = 0; $i < count($request->addMoreInputFieldsSparepart); $i++) {
                // dd($sync_data[$request->addMoreInputFieldsSparepart[$i]['subject']]);
                $findSpare = Sparepart::where('nama_sparepart', $request->addMoreInputFieldsSparepart[$i])->first();
                $spareData[$i] = $findSpare->id;
                $sync_data[$i] = $request->addMoreInputFieldsAmount[$i];
                $invoice->spareparts()->attach($spareData[$i], $sync_data[$i]);
            }

            DB::commit();
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return redirect()->back();
        }
    }

    public function verifiedInvoice($id)
    {
        try {
            $invoice = Invoice::with('spareparts', 'booking')->find($id);
            $booking = Booking::find($invoice->booking->id);

            if ($invoice->is_verified != 1) {
                DB::beginTransaction();
                $invoice->forceFill([
                    'is_verified' => 1
                ])->save();
                $booking->forceFill([
                    'is_complete' => 1
                ])->save();

                $biayaTotalSparepart = 0;
                for ($i = 0; $i < count($invoice->spareparts); $i++) {
                    $biayaTotalSparepart += $invoice->spareparts[$i]->harga_jual * $invoice->spareparts[$i]->pivot->amount;

                    $sparepart = Sparepart::find($invoice->spareparts[$i]->id);
                    $stokSpare = $sparepart->stok - $invoice->spareparts[$i]->pivot->amount;
                    $sparepart->forceFill([
                        'stok' => $stokSpare
                    ])->save();
                }

                $judulTransaksiPemasukkan = 'from_invoices_' . uniqid() . strtolower(Str::random(5));
                Pemasukkan::create([
                    'judul_transaksi_pemasukkan' => $judulTransaksiPemasukkan,
                    'total_biaya' =>  $invoice->total_invoice,
                    'jumlah' => 1,
                    'tanggal' => now()
                ]);
                DB::commit();
            }
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        Invoice::find($id)->delete();
        return redirect()->back();
    }

    public function show($id)
    {
        $invoice = Invoice::with('booking', 'spareparts')->find($id);
        $biayaTotalSparepart = 0;
        for ($i = 0; $i < count($invoice->spareparts); $i++) {
            $biayaTotalSparepart += $invoice->spareparts[$i]->harga_jual * $invoice->spareparts[$i]->pivot->amount;
        }
        return view('admin.booking.show', compact('invoice', 'biayaTotalSparepart'));
    }
}