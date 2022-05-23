<?php

namespace App\Http\Controllers\Admin\Booking;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function bookingList()
    {
        $bookings = Booking::with('invoice')->orderBy('created_at', 'DESC')->get();
        return view('admin.booking.list-booking', compact('bookings'));
    }

    public function bookingDestroy($id)
    {
        Booking::find($id)->delete();
        return redirect()->back();
    }
}