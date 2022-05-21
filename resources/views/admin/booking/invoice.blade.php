@extends('layouts.master')
@section('title')
    Invoice
@endsection

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Invoice</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Invoice</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Waktu Booking</th>
                            <th>Nama Pelanggan</th>
                            <th>Total Tagihan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Waktu Booking</th>
                            <th>Nama Pelanggan</th>
                            <th>Total Tagihan</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($invoices as $item)
                            <tr>
                                <td>{{ $item->booking->waktu_booking }}</td>
                                <td>{{ $item->booking->user->name }}</td>
                                <td>
                                    {{ $item->total_invoice }}
                                </td>
                                <td>
                                    <a href="{{ route('invoice.show', $item->id) }}" type="button"
                                        class="badge rounded-pill bg-warning text-dark">
                                        Tagihan
                                    </a>
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
                                                        Hapus Invoice
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('invoice.destroy', $item->id) }}" method="post">
                                                    @method('DELETE')
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="mb-3 form-group">
                                                            <label for="basicInput">Anda yakin untuk menghapus data
                                                                invoice?</label>
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
        $("#js-example-basic-multiple").select2({
            placeholder: "Pilih Sparepart",
            allowClear: true,
        });
        $("#js-example-basic-single").select2({
            placeholder: "Pilih Data Booking",
            allowClear: true,
        });
    </script>
@endpush
