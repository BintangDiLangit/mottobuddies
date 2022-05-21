@extends('layouts.master')
@section('title')
    Booking Service
@endsection

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Booking Service</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Booking Service</h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Jenis Kendaraan</th>
                            <th>Tipe Kendaraan</th>
                            <th>Tanggal Booking</th>
                            <th>Jam Booking</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Jenis Kendaraan</th>
                            <th>Tipe Kendaraan</th>
                            <th>Tanggal Booking</th>
                            <th>Jam Booking</th>
                            <th>Detail</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($bookings as $item)
                            <tr>
                                <td>
                                    {{ $item->tipeKendaraan->jenis_kendaraan == 'mobil' ? 'Mobil' : 'Motor' }}
                                </td>
                                <td>
                                    {{ $item->tipeKendaraan->nama_tipe_kendaraan }}
                                </td>
                                <td>
                                    @php
                                        $t = strtotime($item->waktu_booking);
                                        echo date('d-M-Y', $t);
                                    @endphp
                                </td>
                                <td>
                                    @php
                                        $t = strtotime($item->waktu_booking);
                                        echo date('H-i', $t) . ' WIB';
                                    @endphp
                                </td>
                                <td>
                                    @if ($item->invoice == null)
                                        <a href="{{ route('booking.show', $item->id) }}" type="button"
                                            class="badge rounded-pill bg-info text-light">
                                            Belum ada tagihan
                                        </a>
                                    @else
                                        <a href="{{ route('booking.show', $item->id) }}" type="button"
                                            class="badge rounded-pill bg-warning text-dark">
                                            Tagihan
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
