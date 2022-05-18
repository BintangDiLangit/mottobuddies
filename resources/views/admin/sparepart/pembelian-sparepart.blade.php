@extends('layouts.master')
@section('title')
    Pembelian Sparepart
@endsection

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Pembelian Sparepart</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Re-Stock Sparepart</h6>
        </div>
        <div class="card-header py-3">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Tambah Data Pembelian
            </button>

            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Tambah Data Pembelian</h5>
                        </div>
                        <form action="{{ route('pembelian-sparepart-kendaraan.store') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3 form-group">
                                    <label for="gambar_sparepart" class="form-label">Sparepart</label>
                                    <select class="form-control js-example-basic-single" id="select2" name="sparepart_id">
                                        <option value="">- Pilih Sperpart -</option>
                                        @foreach ($spareparts as $item)
                                            <option value="{{ $item->id }}">
                                                {{ $item->nama_sparepart . ';' . $item->harga_beli . ';' . $item->satuan }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 form-group">
                                    <label for="nama_sparepart" class="form-label">Nama
                                        Sparepart</label>
                                    <input type="text" class="form-control" placeholder="Nama sparepart"
                                        id="nama_sparepart" aria-describedby="nama_sparepart" disabled value="">
                                </div>
                                <div class="mb-3 form-group">
                                    <label for="harga_beli" class="form-label">Harga
                                        Beli</label>
                                    <input type="text" class="form-control" placeholder="Harga beli satuan"
                                        id="harga_beli" aria-describedby="harga_beli" value="" disabled>
                                </div>
                                <div class="mb-3 form-group">
                                    <label for="jumlah" class="form-label">Jumlah Pembelian</label>
                                    <input type="text" class="form-control" name="jumlah" placeholder="Masukkan jumlah"
                                        id="jumlah" aria-describedby="jumlah">
                                </div>
                                <div class="mb-3 form-group">
                                    <label for="total" class="form-label">Total</label>
                                    <input type="text" class="form-control" name="total" placeholder="Harga total"
                                        id="total" aria-describedby="total" value="">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                                <button type="submit" class="btn btn-primary">Tambah Transaksi</button>
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
                            <th>Nama Sparepart</th>
                            <th>Jumlah Pembelian</th>
                            <th>Harga Total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nama Sparepart</th>
                            <th>Jumlah Pembelian</th>
                            <th>Harga Total</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($pembelianSpareparts as $item)
                            <tr>
                                <td>
                                    {{ $item->sparepart->nama_sparepart }}
                                </td>
                                <td>{{ $item->jumlah }}</td>
                                <td>{{ $item->total }}</td>
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
                                                        Hapus Data Pembelian
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form
                                                    action="{{ route('pembelian-sparepart-kendaraan.destroy', $item->id) }}"
                                                    method="post">
                                                    @method('DELETE')
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="mb-3 form-group">
                                                            <label for="basicInput">Anda yakin untuk menghapus data
                                                                pembelian sparepart?</label>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Kembali</button>
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
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

@push('jsSelect2')
    <script>
        console.log('tes');
        var conceptName = $('#select2').find(":selected").text();
        console.log(conceptName);
        $(document).ready(function() {
            let harga = 0;
            $("#select2").change(function() {
                var selectedData = $(this).children("option:selected").text();
                const myArray = selectedData.split(";");
                nama = myArray[0];
                harga = myArray[1];
                $("#nama_sparepart").val(nama.trim());
                $("#harga_beli").val(harga);
            });
            $("#jumlah").change(function() {
                var jumlah = $("#jumlah").val();

                let total = harga * jumlah;
                $("#total").val(total);
            });
        });
    </script>
@endpush
