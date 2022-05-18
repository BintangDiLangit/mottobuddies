<?php

use App\Http\Controllers\Admin\DataKeuangan\PemasukkanController;
use App\Http\Controllers\Admin\DataKeuangan\PengeluaranController;
use App\Http\Controllers\Admin\Sparepart\PembelianSparepartController;
use App\Http\Controllers\Admin\Sparepart\SparepartController;
use App\Http\Controllers\Admin\TipeKendaraanController;
use App\Http\Controllers\User\BookingController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::prefix('user')->group(function () {
        Route::resource('booking', BookingController::class);
        Route::get('create-mandiri', [BookingController::class, 'createMandiri'])->name('booking.create.mandiri');
        Route::get('cek-tipe', [BookingController::class, 'cekTipe'])->name('booking.cek.tipe');
        Route::get('search-booking', [BookingController::class, 'searchBooking'])->name('booking.search');
        Route::post('store-mandiri', [BookingController::class, 'storeMandiri'])->name('booking.store.mandiri');
    });
    Route::prefix('admin')->group(function () {
        Route::resource('tipe-kendaraan', TipeKendaraanController::class);
        Route::resource('sparepart-kendaraan', SparepartController::class);
        Route::resource('pembelian-sparepart-kendaraan', PembelianSparepartController::class);
        Route::resource('pemasukkan', PemasukkanController::class);
        Route::resource('pengeluaran', PengeluaranController::class);
    });
});