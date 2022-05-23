<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Pemasukkan;
use App\Models\Pengeluaran;
use App\Models\TipsTrik;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->is_admin == 1) {
            # code...

            $pendingBooking = Booking::where('is_complete', 0)->count();
            $completeBooking = Booking::where('is_complete', 1)->count();
            $pemasukkan = Pemasukkan::where(function ($query) {
                $query->whereYear('tanggal', Carbon::now()->year);
            })->sum('total_biaya');
            $pengeluaran = Pengeluaran::where(function ($query) {
                $query->whereYear('tanggal', Carbon::now()->year);
            })->sum('total_biaya');
            $omsetTahunan =  $pemasukkan - $pengeluaran;

            $p = Pengeluaran::where(function ($query) {
                $query->whereMonth('tanggal', Carbon::now()->month);
            })->sum('total_biaya');

            $p1 = Pengeluaran::where(function ($query) {
                $query->whereMonth('tanggal', Carbon::now()->subMonth(1));
            })->sum('total_biaya');

            $p2 = Pengeluaran::where(function ($query) {
                $query->whereMonth('tanggal', Carbon::now()->subMonth(2));
            })->sum('total_biaya');

            $p3 = Pengeluaran::where(function ($query) {
                $query->whereMonth('tanggal', Carbon::now()->subMonth(3));
            })->sum('total_biaya');

            $p4 = Pengeluaran::where(function ($query) {
                $query->whereMonth('tanggal', Carbon::now()->subMonth(4));
            })->sum('total_biaya');
            $p5 = Pengeluaran::where(function ($query) {
                $query->whereMonth('tanggal', Carbon::now()->subMonth(5));
            })->sum('total_biaya');
            $p6 = Pengeluaran::where(function ($query) {
                $query->whereMonth('tanggal', Carbon::now()->subMonth(6));
            })->sum('total_biaya');
            $p7 = Pengeluaran::where(function ($query) {
                $query->whereMonth('tanggal', Carbon::now()->subMonth(7));
            })->sum('total_biaya');
            $p8 = Pengeluaran::where(function ($query) {
                $query->whereMonth('tanggal', Carbon::now()->subMonth(8));
            })->sum('total_biaya');
            $p9 = Pengeluaran::where(function ($query) {
                $query->whereMonth('tanggal', Carbon::now()->subMonth(9));
            })->sum('total_biaya');
            $p10 = Pengeluaran::where(function ($query) {
                $query->whereMonth('tanggal', Carbon::now()->subMonth(10));
            })->sum('total_biaya');
            $p11 = Pengeluaran::where(function ($query) {
                $query->whereMonth('tanggal', Carbon::now()->subMonth(11));
            })->sum('total_biaya');


            $pm = Pemasukkan::where(function ($query) {
                $query->whereMonth('tanggal', Carbon::now()->month);
            })->sum('total_biaya');

            $pm1 = Pemasukkan::where(function ($query) {
                $query->whereMonth('tanggal', Carbon::now()->subMonth(1));
            })->sum('total_biaya');

            $pm2 = Pemasukkan::where(function ($query) {
                $query->whereMonth('tanggal', Carbon::now()->subMonth(2));
            })->sum('total_biaya');

            $pm3 = Pemasukkan::where(function ($query) {
                $query->whereMonth('tanggal', Carbon::now()->subMonth(3));
            })->sum('total_biaya');

            $pm4 = Pemasukkan::where(function ($query) {
                $query->whereMonth('tanggal', Carbon::now()->subMonth(4));
            })->sum('total_biaya');
            $pm5 = Pemasukkan::where(function ($query) {
                $query->whereMonth('tanggal', Carbon::now()->subMonth(5));
            })->sum('total_biaya');
            $pm6 = Pemasukkan::where(function ($query) {
                $query->whereMonth('tanggal', Carbon::now()->subMonth(6));
            })->sum('total_biaya');
            $pm7 = Pemasukkan::where(function ($query) {
                $query->whereMonth('tanggal', Carbon::now()->subMonth(7));
            })->sum('total_biaya');
            $pm8 = Pemasukkan::where(function ($query) {
                $query->whereMonth('tanggal', Carbon::now()->subMonth(8));
            })->sum('total_biaya');
            $pm9 = Pemasukkan::where(function ($query) {
                $query->whereMonth('tanggal', Carbon::now()->subMonth(9));
            })->sum('total_biaya');
            $pm10 = Pemasukkan::where(function ($query) {
                $query->whereMonth('tanggal', Carbon::now()->subMonth(10));
            })->sum('total_biaya');
            $pm11 = Pemasukkan::where(function ($query) {
                $query->whereMonth('tanggal', Carbon::now()->subMonth(11));
            })->sum('total_biaya');

            $pf = array(
                $p, $pm
            );
            $pf1 = array(
                $p1, $pm1
            );
            $pf2 = array(
                $p2, $pm2
            );
            $pf3 = array(
                $p3, $pm3
            );
            $pf4 = array(
                $p4, $pm4
            );
            $pf5 = array(
                $p5, $pm5
            );
            $pf6 = array(
                $p6, $pm6
            );
            $pf7 = array(
                $p7, $pm7
            );
            $pf8 = array(
                $p8, $pm8
            );
            $pf9 = array(
                $p9, $pm9
            );
            $pf10 = array(
                $p10, $pm10
            );
            $pf11 = array(
                $p11, $pm11
            );

            $omsetBulanan = $pm - $p;

            return view('dashboard', compact('pf', 'pf1', 'pf2', 'pf3', 'pf4', 'pf5', 'pf6', 'pf7', 'pf8', 'pf9', 'pf10', 'pf11', 'omsetTahunan', 'omsetBulanan', 'pendingBooking', 'completeBooking'));
        } else {
            $tips = TipsTrik::with('tipeKendaraan')->orderBy('updated_at', 'DESC')->get();
            return view('dashboard', compact('tips'));
        }
    }
}