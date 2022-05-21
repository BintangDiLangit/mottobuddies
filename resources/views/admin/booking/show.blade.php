@extends('layouts.master')
@section('title')
    Detail Tagihan Booking Service
@endsection

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Detail Tagihan Booking Service</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <p class="m-0 font-weight-bold text-primary">Nama Pelanggan :
                {{ $invoice->booking->user->name }}
            </p>
            <p class="m-0 font-weight-bold text-primary">Jenis Kendaraan :
                {{ $invoice->booking->tipeKendaraan->nama_tipe_kendaraan == 'mobil' ? 'Mobil' : 'Motor' }}
            </p>
            <p class="m-0 font-weight-bold text-primary">Nama Kendaraan :
                {{ $invoice->booking->tipeKendaraan->nama_tipe_kendaraan }}
            </p>
            <p class="m-0 font-weight-bold text-primary">Tanggal Booking :
                {{ $invoice->booking->waktu_booking }}
            </p>

        </div>
        <div class="card-header py-3">
            <h2 class="m-0 font-weight-bold text-primary">Tagihan</h2>
        </div>

        <div class="card-body">
            <div class="card-header py-3 mb-3">
                <h6 class="m-0 font-weight-bold text-primary">List Biaya Sparepart</h6>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama Sparepart</th>
                            <th>Harga</th>
                            <th>Kuantitas</th>
                            <th>Gambar</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nama Sparepart</th>
                            <th>Harga</th>
                            <th>Kuantitas</th>
                            <th>Gambar</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($invoice->spareparts as $item)
                            <tr>
                                <td>
                                    {{ $item->nama_sparepart }}
                                </td>
                                <td>
                                    {{ $item->harga_jual }}
                                </td>
                                <td>
                                    {{ $item->pivot->amount }}
                                </td>
                                <td>
                                    <img src="{{ $item->gambar_sparepart }}" width="100px" alt="">
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <div class="card-header py-3 mt-4">
                <h6 class="m-0 text-primary text-right">Total Biaya Sparepart :
                    {{ $biayaTotalSparepart }}</h6>
            </div>
            <div class="card-header py-3 mt-2">
                <h6 class="m-0 text-primary text-right">Biaya Service :
                    {{ $invoice->total_invoice - $biayaTotalSparepart }}</h6>
            </div>
            <div class="card-header py-3 mt-4">
                <h6 class="m-0 font-weight-bold text-primary text-right">Total Tagihan :
                    {{ $invoice->total_invoice }}</h6>
            </div>
            @if ($invoice->bukti_bayar != null && $invoice->is_verified == 0)
                <button type="button" class="btn btn-outline-warning btn-block mt-3" data-bs-toggle="modal"
                    data-bs-target="#exampleModalBayar">
                    Menunggu Verifikasi
                </button>
            @elseif ($invoice->bukti_bayar != null && $invoice->is_verified == 1)
                <button type="button" disabled class="btn btn-outline-secondary btn-block mt-3">
                    Pembayaran Telah Diverifikasi
                </button>
            @else
                <button type="button" disabled class="btn btn-outline-success btn-block mt-3">
                    Bukti Belum Dikirim
                </button>
            @endif
            <div class="modal fade" id="exampleModalBayar" tabindex="-1" aria-labelledby="exampleModalLabelBayar"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabelBayar">
                                Tagihan
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="{{ route('verified.invoice', ['invoiceid' => $invoice->id]) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3 form-group">
                                    <label for="basicInput">Bayar di nomor rek. 125903002721 - an. Michael</label>
                                    <img src="{{ $invoice->bukti_bayar }}" class="mb-3" width="100%" alt="">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                                <button type="submit" class="btn btn-primary">Verifikasi Pembayaran</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <a href="{{ route('invoice.index') }}" type="button" class="btn btn-outline-danger btn-block mt-3">
                Kembali
            </a>
        </div>
    </div>
@endsection
