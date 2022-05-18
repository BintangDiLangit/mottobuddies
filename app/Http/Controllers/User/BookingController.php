<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\TipeKendaraan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('tipeKendaraan', 'user')->where('user_id', Auth::user()->id)->get();
        return view('user.booking.index', compact('bookings'));
    }

    public function create()
    {
        $tipeKendaraansUser = TipeKendaraan::whereHas('bookings', function ($query) {
            return $query->where([['user_id', '=', Auth::user()->id], ['is_complete', '=', 1]]);
        })->get();
        return view('user.booking.cek-tipe', compact('tipeKendaraansUser'));
    }
    public function createMandiri()
    {
        return view('user.booking.cek-booking');
    }

    public function storeMandiri(Request $request)
    {
        $waktu =  $request->tanggal_booking . ' ' . $request->jam_booking;
        Booking::create([
            'user_id' => Auth::user()->id,
            'tipe_kendaraan_id' => $request->tipe_kendaraan_id,
            'waktu_booking' => $waktu,
        ]);

        return redirect(route('booking.index'));
    }
    public function store(Request $request)
    {
        Booking::create([
            'user_id' => Auth::user()->id,
            'tipe_kendaraan_id' => $request->tipe_kendaraan_id,
            'waktu_booking' => $request->rekom_booking,
        ]);

        return redirect(route('booking.index'));
    }

    public function searchBooking(Request $request)
    {
        $tgl = $request->tanggal_booking;
        $searchBookings = Booking::where('waktu_booking', 'LIKE', '%' . $tgl . '%')->get();
        if ($searchBookings != null) {
            # code...

            $time1 = '09:00:00';
            $time2 = '10:00:00';
            $time3 = '11:00:00';
            $time4 = '12:00:00';
            $time5 = '13:00:00';
            $time6 = '14:00:00';
            $searchBookingTimes1 = count(Booking::where([['waktu_booking', 'LIKE', '%' . $tgl . '%'], ['waktu_booking', 'LIKE', '%' . $time1 . '%'], ['is_complete', 0]])->get());
            $searchBookingTimes2 = count(Booking::where([['waktu_booking', 'LIKE', '%' . $tgl . '%'], ['waktu_booking', 'LIKE', '%' . $time2 . '%'], ['is_complete', 0]])->get());
            $searchBookingTimes3 = count(Booking::where([['waktu_booking', 'LIKE', '%' . $tgl . '%'], ['waktu_booking', 'LIKE', '%' . $time3 . '%'], ['is_complete', 0]])->get());
            $searchBookingTimes4 = count(Booking::where([['waktu_booking', 'LIKE', '%' . $tgl . '%'], ['waktu_booking', 'LIKE', '%' . $time4 . '%'], ['is_complete', 0]])->get());
            $searchBookingTimes5 = count(Booking::where([['waktu_booking', 'LIKE', '%' . $tgl . '%'], ['waktu_booking', 'LIKE', '%' . $time5 . '%'], ['is_complete', 0]])->get());
            $searchBookingTimes6 = count(Booking::where([['waktu_booking', 'LIKE', '%' . $tgl . '%'], ['waktu_booking', 'LIKE', '%' . $time6 . '%'], ['is_complete', 0]])->get());

            $searchBookingTimes = [
                $searchBookingTimes1,
                $searchBookingTimes2,
                $searchBookingTimes3,
                $searchBookingTimes4,
                $searchBookingTimes5,
                $searchBookingTimes6
            ];
            $tipeKendaraans = TipeKendaraan::all();

            return view('user.booking.create-mandiri', compact('tipeKendaraans', 'searchBookings', 'searchBookingTimes'));
        }
    }

    public function cekTipe(Request $request)
    {
        $tipe_id = $request->tipe_kendaraan_id;
        $tipe = Booking::with('tipeKendaraan')->where([['tipe_kendaraan_id',  $tipe_id], ['user_id', Auth::user()->id], ['is_complete', 1]])->orderBy('waktu_booking', 'DESC')->first();

        $addingMonths = new Carbon($tipe->waktu_booking);
        $recommendation = $addingMonths->addMonths(3);
        return view('user.booking.create', compact('tipe', 'recommendation'));
    }
}