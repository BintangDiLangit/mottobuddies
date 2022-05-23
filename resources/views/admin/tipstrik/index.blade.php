@extends('layouts.master')
@section('title')
    Tips & Tricks
@endsection

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tips & Tricks</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tips & Tricks</h6>
        </div>
        <div class="card-header py-3">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Tambah Tips & Tricks
            </button>

            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Tips & Tricks</h5>
                        </div>
                        <form action="{{ route('tips-tricks.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3 form-group">
                                    <label for="tipeKendaraan" class="form-label">Tipe Kendaraan</label>
                                    <br>
                                    <select class="form-control js-example-basic-single" id="js-example-basic-single"
                                        name="tipe_kendaraan_id">
                                        <option value="">- Pilih Tipe Kendaraan -</option>
                                        @foreach ($tipeKendaraans as $item)
                                            <option value="{{ $item->id }}">
                                                {{ $item->jenis_kendaraan == 'mobil' ? 'Mobil' : 'Motor' }} -
                                                {{ $item->nama_tipe_kendaraan }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 form-group">
                                    <label for="judul" class="form-label">Judul</label>
                                    <input type="text" class="form-control" name="judul" placeholder="Masukkan judul"
                                        id="judul" aria-describedby="judul">
                                </div>
                                <div class="mb-3 form-group">
                                    <label for="isi" class="form-label">Isi</label>
                                    <textarea name="isi" class="form-control" id="isi" cols="30" rows="10" placeholder="Masukkan isi"></textarea>
                                </div>
                                <div class="mb-3 form-group">
                                    <label for="gambar" class="form-label">Gambar</label>
                                    <input type="file" class="form-control" name="gambar" id="gambar"
                                        aria-describedby="gambar">
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
                            <th>Judul</th>
                            <th>Jenis Kendaraan</th>
                            <th>Tipe Kendaraan</th>
                            <th>Isi</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Judul</th>
                            <th>Jenis Kendaraan</th>
                            <th>Tipe Kendaraan</th>
                            <th>Isi</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($tips as $item)
                            <tr>
                                <td>
                                    {{ $item->judul }}
                                </td>
                                <td>
                                    {{ $item->tipeKendaraan->jenis_kendaraan == 'mobil' ? 'Mobil' : 'Motor' }}
                                </td>
                                <td>
                                    {{ $item->tipeKendaraan->nama_tipe_kendaraan }}
                                </td>
                                <td>{{ $item->isi }}</td>
                                <td><img src="{{ $item->gambar }}" width="100" alt="" srcset=""></td>
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
                                                        Tips & Tricks</h5>
                                                </div>
                                                <form action="{{ route('tips-tricks.update', $item->id) }}" method="post"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="mb-3 form-group">
                                                            <label for="tipeKendaraan" class="form-label">Tipe
                                                                Kendaraan</label>
                                                            <br>
                                                            <select class="form-control js-example-basic-single"
                                                                id="js-example-basic-single" name="tipe_kendaraan_id">
                                                                <option value="">- Pilih Tipe Kendaraan -</option>
                                                                @foreach ($tipeKendaraans as $item2)
                                                                    <option value="{{ $item2->id }}"
                                                                        {{ $item->tipeKendaraan->id == $item2->id ? 'selected' : '' }}>
                                                                        {{ $item2->jenis_kendaraan == 'mobil' ? 'Mobil' : 'Motor' }}
                                                                        -
                                                                        {{ $item2->nama_tipe_kendaraan }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="mb-3 form-group">
                                                            <label for="judul" class="form-label">Judul</label>
                                                            <input type="text" class="form-control" name="judul"
                                                                placeholder="Masukkan judul" value="{{ $item->judul }}"
                                                                id="judul" aria-describedby="judul">
                                                        </div>
                                                        <div class="mb-3 form-group">
                                                            <label for="isi" class="form-label">Isi</label>
                                                            <textarea name="isi" class="form-control" id="isi" cols="30" rows="10"
                                                                placeholder="Masukkan isi">{{ $item->isi }}</textarea>
                                                        </div>
                                                        <div class="mb-3 form-group">
                                                            <img src="{{ $item->gambar }}" width="100%" alt="" srcset="">
                                                            <label for="gambar" class="form-label">Update
                                                                Gambar?</label>
                                                            <input type="file" class="form-control" name="gambar"
                                                                id="gambar" aria-describedby="gambar">
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
                                                        Hapus Tips & Tricks
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('tips-tricks.destroy', $item->id) }}"
                                                    method="post">
                                                    @method('DELETE')
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="mb-3 form-group">
                                                            <label for="basicInput">Anda yakin untuk menghapus data
                                                                tips & tricks?</label>
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

@push('jsSelect2')
    <script>
        $("#js-example-basic-single").select2({
            placeholder: "Pilih Tipe",
            allowClear: true,
        });
    </script>
@endpush
