@extends('layouts.master')
@section('title')
    Data Kendaraan
@endsection

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data Tipe Kendaraan</h1>
    <p class="mb-4">Tipe data kendaraan digunakan untuk membantu menspesifikasikan tipe service kendaraan yang ada.
    </p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Tipe Kendaraan</h6>
        </div>
        <div class="card-header py-3">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Tambah Data Tipe Kendaraan
            </button>

            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Tipe Kendaraan</h5>
                        </div>
                        <form action="{{ route('tipe-kendaraan.store') }}" method="post">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3 form-group">
                                    <label for="jenis_kendaraan" class="form-label">Jenis Kendaraan</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jenis_kendaraan"
                                            id="jenis_kendaraan" value="mobil">
                                        <label class="form-check-label" for="jenis_kendaraan">
                                            Mobil
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jenis_kendaraan"
                                            id="jenis_kendaraan" value="motor">
                                        <label class="form-check-label" for="jenis_kendaraan">
                                            Motor
                                        </label>
                                    </div>
                                </div>
                                <div class="mb-3 form-group">
                                    <label for="nama_tipe_kendaraan" class="form-label">Tipe Kendaraan</label>
                                    <input type="text" class="form-control" name="nama_tipe_kendaraan"
                                        placeholder="Masukkan tipe kendaraan" id="nama_tipe_kendaraan"
                                        aria-describedby="nama_tipe_kendaraan">
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
                            <th>Jenis Kendaraan</th>
                            <th>Tipe Kendaraan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Jenis Kendaraan</th>
                            <th>Tipe Kendaraan</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($tipeKendaraans as $item)
                            <tr>
                                <td>
                                    {{ $item->jenis_kendaraan == 'mobil' ? 'Mobil' : 'Motor' }}
                                </td>
                                <td>{{ $item->nama_tipe_kendaraan }}</td>
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
                                                        Tipe Kendaraan</h5>
                                                </div>
                                                <form action="{{ route('tipe-kendaraan.update', $item->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="mb-3 form-group">
                                                            <label for="jenis_kendaraan" class="form-label">Jenis
                                                                Kendaraan</label>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                    name="jenis_kendaraan" id="jenis_kendaraan"
                                                                    value="mobil"
                                                                    {{ $item->jenis_kendaraan == 'mobil' ? 'checked' : '' }}>
                                                                <label class="form-check-label" for="jenis_kendaraan">
                                                                    Mobil
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                    name="jenis_kendaraan" id="jenis_kendaraan"
                                                                    value="motor"
                                                                    {{ $item->jenis_kendaraan == 'motor' ? 'checked' : '' }}>
                                                                <label class="form-check-label" for="jenis_kendaraan">
                                                                    Motor
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 form-group">
                                                            <label for="nama_tipe_kendaraan" class="form-label">Tipe
                                                                Kendaraan</label>
                                                            <input type="text" class="form-control"
                                                                name="nama_tipe_kendaraan"
                                                                placeholder="Masukkan tipe kendaraan"
                                                                id="nama_tipe_kendaraan"
                                                                aria-describedby="nama_tipe_kendaraan"
                                                                value="{{ $item->nama_tipe_kendaraan }}">
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
                                                        Hapus Data Kendaraan
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('tipe-kendaraan.destroy', $item->id) }}"
                                                    method="post">
                                                    @method('DELETE')
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="mb-3 form-group">
                                                            <label for="basicInput">Anda yakin untuk menghapus data
                                                                kendaraan?</label>
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
