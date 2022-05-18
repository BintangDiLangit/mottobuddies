@extends('layouts.master')
@section('title')
    Pemasukkan
@endsection

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Pemasukkan</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Pemasukkan</h6>
        </div>
        <div class="card-header py-3">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Tambah Pemasukkan
            </button>

            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Tambah Pemasukkan</h5>
                        </div>
                        <form action="{{ route('pemasukkan.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3 form-group">
                                    <label for="judul_transaksi_pemasukkan" class="form-label">Judul Transaksi
                                        Pemasukkan</label>
                                    <input type="text" class="form-control" name="judul_transaksi_pemasukkan"
                                        placeholder="Masukkan nama sparepart" id="judul_transaksi_pemasukkan"
                                        aria-describedby="judul_transaksi_pemasukkan">
                                </div>
                                <div class="mb-3 form-group">
                                    <label for="jumlah" class="form-label">Jumlah Barang</label>
                                    <input type="number" class="form-control" name="jumlah"
                                        placeholder="Masukkan harga jual" id="jumlah" aria-describedby="jumlah">
                                </div>
                                <div class="mb-3 form-group">
                                    <label for="total_biaya" class="form-label">Total Biaya</label>
                                    <input type="number" class="form-control" name="total_biaya"
                                        placeholder="Masukkan total biaya" id="total_biaya" aria-describedby="total_biaya">
                                </div>
                                <div class="mb-3 form-group">
                                    <label for="tanggal" class="form-label">Tanggal</label>
                                    <input type="date" class="form-control" name="tanggal"
                                        placeholder="Masukkan harga jual" id="tanggal" aria-describedby="tanggal">
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Judul Transaksi Pemasukkan</th>
                            <th>Jumlah</th>
                            <th>Total Biaya</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Judul Transaksi Pemasukkan</th>
                            <th>Jumlah</th>
                            <th>Total Biaya</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($pemasukkans as $item)
                            <tr>
                                <td>
                                    {{ $item->judul_transaksi_pemasukkan }}
                                </td>
                                <td>{{ $item->jumlah }}</td>
                                <td>{{ $item->total_biaya }}</td>
                                <td>
                                    <button type="button" class="badge rounded-pill bg-danger text-light"
                                        data-bs-toggle="modal" data-bs-target="#exampleModalDelete{{ $item->id }}">
                                        Hapus
                                    </button>
                                    <div class="modal fade" id="exampleModalDelete{{ $item->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabelDelete{{ $item->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"
                                                        id="exampleModalLabelDelete{{ $item->id }}">
                                                        Hapus Pemasukkan
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('pemasukkan.destroy', $item->id) }}" method="post">
                                                    @method('DELETE')
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="mb-3 form-group">
                                                            <label for="basicInput">Anda yakin untuk menghapus data
                                                                pemasukkan?</label>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Kembali</button>
                                                        <button type="submit" class="btn btn-primary">Hapus</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
