@extends('layouts.master')
@section('title')
    Info Produk
@endsection

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Info Produk</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Info Produk</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Gambar</th>
                            <th>Satuan</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Gambar</th>
                            <th>Satuan</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($products as $item)
                            <tr>
                                <td>
                                    {{ $item->nama_sparepart }}
                                </td>
                                <td>{{ $item->harga_jual }}</td>
                                <td>{{ $item->stok }}</td>
                                <td><img src="{{ $item->gambar_sparepart }}" width="100px" alt=""></td>
                                <td>{{ $item->satuan }}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
