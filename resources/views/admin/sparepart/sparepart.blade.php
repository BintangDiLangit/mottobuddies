@extends('layouts.master')
@section('title')
    Data Sparepart
@endsection

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data Sparepart</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Sparepart</h6>
        </div>
        <div class="card-header py-3">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Tambah Data Sparepart
            </button>

            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Tambah Data Sparepart</h5>
                        </div>
                        <form action="{{ route('sparepart-kendaraan.store') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3 form-group">
                                    <label for="nama_sparepart" class="form-label">Nama Sparepart</label>
                                    <input type="text" class="form-control" name="nama_sparepart"
                                        placeholder="Masukkan nama sparepart" id="nama_sparepart"
                                        aria-describedby="nama_sparepart">
                                </div>
                                <div class="mb-3 form-group">
                                    <label for="harga_beli" class="form-label">Harga Beli</label>
                                    <input type="text" class="form-control" name="harga_beli"
                                        placeholder="Masukkan harga beli" id="harga_beli" aria-describedby="harga_beli">
                                </div>
                                <div class="mb-3 form-group">
                                    <label for="harga_jual" class="form-label">Harga Jual</label>
                                    <input type="text" class="form-control" name="harga_jual"
                                        placeholder="Masukkan harga jual" id="harga_jual" aria-describedby="harga_jual">
                                </div>
                                <div class="mb-3 form-group">
                                    <label for="gambar_sparepart" class="form-label">Gambar Sparepart</label>
                                    <input type="file" class="form-control" name="gambar_sparepart"
                                        placeholder="Masukkan gambar sparepart" id="gambar_sparepart"
                                        aria-describedby="gambar_sparepart">
                                </div>
                                <div class="mb-3 form-group">
                                    <label for="gambar_sparepart" class="form-label">Satuan</label>
                                    <select class="form-control js-example-basic-single" name="satuan">
                                        <option value="">- Pilih Jenis Satuan -</option>
                                        <option value="Pcs">Pcs</option>
                                        <option value="Pack">Pack</option>
                                        <option value="Lusin">Lusin</option>
                                        <option value="Kaleng">Kaleng</option>
                                    </select>
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
                            <th>Nama Sparepart</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
                            <th>Stok</th>
                            <th>Gambar</th>
                            <th>Satuan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nama Sparepart</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
                            <th>Stok</th>
                            <th>Gambar</th>
                            <th>Satuan</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($spareparts as $item)
                            <tr>
                                <td>
                                    {{ $item->nama_sparepart }}
                                </td>
                                <td>{{ $item->harga_beli }}</td>
                                <td>{{ $item->harga_jual }}</td>
                                <td>{{ $item->stok }}</td>
                                <td><img src="{{ $item->gambar_sparepart }}" width="100px" alt=""></td>
                                <td>{{ $item->satuan }}</td>
                                <td>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="badge rounded-pill bg-warning text-dark"
                                        data-bs-toggle="modal" data-bs-target="#modal{{ $item->id }}">
                                        Edit
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="modal{{ $item->id }}" data-bs-backdrop="static"
                                        data-bs-keyboard="false" tabindex="-1"
                                        aria-labelledby="staticBackdropLabel{{ $item->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel{{ $item->id }}">
                                                        Data Sparepart</h5>
                                                </div>
                                                <form action="{{ route('sparepart-kendaraan.update', $item->id) }}"
                                                    method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="mb-3 form-group">
                                                            <label for="nama_sparepart" class="form-label">Nama
                                                                Sparepart</label>
                                                            <input type="text" class="form-control" name="nama_sparepart"
                                                                placeholder="Masukkan nama sparepart" id="nama_sparepart"
                                                                aria-describedby="nama_sparepart"
                                                                value="{{ $item->nama_sparepart }}">
                                                        </div>
                                                        <div class="mb-3 form-group">
                                                            <label for="harga_beli" class="form-label">Harga
                                                                Beli</label>
                                                            <input type="text" class="form-control" name="harga_beli"
                                                                placeholder="Masukkan harga beli" id="harga_beli"
                                                                aria-describedby="harga_beli"
                                                                value="{{ $item->harga_beli }}">
                                                        </div>
                                                        <div class="mb-3 form-group">
                                                            <label for="harga_jual" class="form-label">Harga
                                                                Jual</label>
                                                            <input type="text" class="form-control" name="harga_jual"
                                                                placeholder="Masukkan harga jual" id="harga_jual"
                                                                aria-describedby="harga_jual"
                                                                value="{{ $item->harga_jual }}">
                                                        </div>
                                                        <div class="mb-3 form-group">
                                                            <img src="{{ $item->gambar_sparepart }}" width="100px"
                                                                alt="">
                                                        </div>
                                                        <div class="mb-3 form-group">
                                                            <label for="gambar_sparepart" class="form-label">Gambar
                                                                Sparepart Baru</label>
                                                            <input type="file" class="form-control"
                                                                name="gambar_sparepart"
                                                                placeholder="Masukkan gambar sparepart"
                                                                id="gambar_sparepart" aria-describedby="gambar_sparepart">
                                                        </div>
                                                        <div class="mb-3 form-group">
                                                            <label for="gambar_sparepart"
                                                                class="form-label">Satuan</label>
                                                            <select class="form-control js-example-basic-single"
                                                                name="satuan">
                                                                <option value="">- Pilih Jenis Satuan -</option>
                                                                <option value="Pcs"
                                                                    {{ $item->satuan == 'Pcs' ? 'selected' : '' }}>Pcs
                                                                </option>
                                                                <option value="Pack"
                                                                    {{ $item->satuan == 'Pack' ? 'selected' : '' }}>Pack
                                                                </option>
                                                                <option value="Lusin"
                                                                    {{ $item->satuan == 'Lusin' ? 'selected' : '' }}>
                                                                    Lusin</option>
                                                                <option value="Kaleng"
                                                                    {{ $item->satuan == 'Kaleng' ? 'selected' : '' }}>
                                                                    Kaleng</option>
                                                            </select>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Kembali</button>
                                                        <button type="submit" class="btn btn-primary">Edit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

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
                                                        Hapus Data Sparepart
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('sparepart-kendaraan.destroy', $item->id) }}"
                                                    method="post">
                                                    @method('DELETE')
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="mb-3 form-group">
                                                            <label for="basicInput">Anda yakin untuk menghapus data
                                                                sparepart?</label>
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
