@extends('layouts.master')
@section('title')
    Booking
@endsection

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Booking</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Booking</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Di Booking Pada Tanggal</th>
                            <th>Waktu Booking</th>
                            <th>Nama Pelanggan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Di Booking Pada Tanggal</th>
                            <th>Waktu Booking</th>
                            <th>Nama Pelanggan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($bookings as $item)
                            <tr>
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->waktu_booking }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>
                                    @if ($item->invoice == null)
                                        <button type="button" class="badge rounded-pill bg-info text-light">
                                            Tagihan belum dibuat
                                        </button>
                                    @elseif ($item->is_complete == 1)
                                        <button type="button" class="badge rounded-pill bg-success text-light">
                                            Pembayaran Selesai
                                        </button>
                                    @else
                                        <button type="button" class="badge rounded-pill bg-warning text-light">
                                            Tagihan belum dibayar
                                        </button>
                                    @endif
                                </td>
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
                                                        Hapus Booking
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('admin.booking.destroy', $item->id) }}"
                                                    method="post">
                                                    @method('DELETE')
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="mb-3 form-group">
                                                            <label for="basicInput">Anda yakin untuk menghapus data
                                                                booking ini?</label>
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
