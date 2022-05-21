@extends('layouts.master')

@section('title')
    Create Invoice
@endsection

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Create Invoice</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Create Invoice</h6>
        </div>
        <div class="card-header py-3">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                List Sparepart
            </button>

            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Cari Sparepart</h5>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nama Sparepart</th>
                                            <th>Harga Jual</th>
                                            <th>Sisa Stok</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Nama Sparepart</th>
                                            <th>Harga Jual</th>
                                            <th>Sisa Stok</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($spareparts as $item)
                                            <tr>
                                                <td>
                                                    {{ $item->nama_sparepart }}
                                                </td>
                                                <td>{{ $item->harga_jual }}</td>
                                                <td>{{ $item->stok }}</td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <form action="{{ route('invoice.store') }}" method="post">
                @csrf
                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (Session::has('success'))
                    <div class="alert alert-success text-center">
                        <p>{{ Session::get('success') }}</p>
                    </div>
                @endif
                <div class="mb-3 form-group">
                    <label for="booking_id" class="form-label">Booking</label>
                    <br>
                    <select class="form-control js-example-basic-single" id="js-example-basic-single" name="booking_id">
                        <option value="">- Pilih Data Booking -</option>
                        @foreach ($bookings as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->user->name }} -
                                {{ $item->tipeKendaraan->nama_tipe_kendaraan }} - Waktu :
                                {{ $item->waktu_booking }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <table class="table table-bordered" id="dynamicAddRemove">
                    <tr>
                        <th>Sparepart</th>
                        <th>Amount</th>
                        <th>Action</th>
                    </tr>
                    <tr>
                        <td><input type="text" name="addMoreInputFieldsSparepart[0][subject]"
                                placeholder="Enter nama sparepart" class="form-control" />
                        </td>
                        <td><input type="text" name="addMoreInputFieldsAmount[0][amount]" placeholder="Enter amount"
                                class="form-control" />
                        </td>
                        <td><button type="button" name="add" id="dynamic-ar" class="btn btn-outline-primary">Add
                                Sparepart</button></td>
                    </tr>
                </table>
                <div class="mb-3 form-group">
                    <label for="biaya_service" class="form-label">Biaya Service</label>
                    <input type="number" class="form-control" name="biaya_service" placeholder="Masukkan biaya service"
                        id="biaya_service" aria-describedby="biaya_service">
                </div>
                <button type="submit" class="btn btn-outline-success btn-block">Save</button>
            </form>
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
    <script type="text/javascript">
        var i = 0;
        $("#dynamic-ar").click(function() {
            ++i;
            $("#dynamicAddRemove").append('<tr><td><input type="text" name="addMoreInputFieldsSparepart[' + i +
                '][subject]" placeholder="Enter subject" class="form-control" /></td>  <td><input type="text" name="addMoreInputFieldsAmount[' +
                i +
                '][amount]" placeholder="Enter amount" class="form-control" /></td> <td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td></tr>'
            );
        });
        $(document).on('click', '.remove-input-field', function() {
            $(this).parents('tr').remove();
        });
    </script>
@endpush
