@extends('layouts.master')

@section('title')
    Buat Booking Mandiri
@endsection

@section('content')
    <style>
        .card-input-element {
            display: none;
        }

        .card-input {
            margin: 10px;
            padding: 0px;
        }

        .card-input:hover {
            cursor: pointer;
        }

        .card-input-element:checked+.card-input {
            box-shadow: 0 0 1px 1px #2ecc71;
        }

    </style>
    <form action="{{ route('booking.store.mandiri') }}" method="post">
        @csrf
        <div>
            <input type="text" name="tanggal_booking" value="{{ $_GET['tanggal_booking'] }}" hidden>
            <div class="mb-3">
                <label for="tipeKendaraan" class="form-label"> Tipe Kendaraan </label> <select
                    class="form-control js-example-basic-single" id="js-example-basic-single" name="tipe_kendaraan_id">
                    <option value=""> -Pilih Tipe Kendaraan - </option>
                    @foreach ($tipeKendaraans as $item)
                        <option value="{{ $item->id }}">
                            {{ $item->jenis_kendaraan == 'mobil' ? 'Mobil' : 'Motor' }} -
                            {{ $item->nama_tipe_kendaraan }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="jam" class="form-label">Jam</label>
                <div class="form-group">
                    @if ($searchBookingTimes[0] >= 2)
                        <label>
                            <input type="radio" name="jam_booking" class="card-input-element" disabled />

                            <div class="card card-default card-input" style="color: red">
                                <div class="card-header">09:00</div>
                            </div>
                        </label>
                    @else
                        <label>
                            <input type="radio" name="jam_booking" class="card-input-element" value="09:00:00" />
                            <div class="card card-default card-input">
                                <div class="card-header">09:00</div>
                            </div>
                        </label>
                    @endif
                    @if ($searchBookingTimes[1] >= 2)
                        <label>
                            <input type="radio" name="jam_booking" class="card-input-element" disabled />

                            <div class="card card-default card-input" style="color: red">
                                <div class="card-header">10:00</div>
                            </div>
                        </label>
                    @else
                        <label>
                            <input type="radio" name="jam_booking" class="card-input-element" value="10:00:00" />
                            <div class="card card-default card-input">
                                <div class="card-header">10:00</div>
                            </div>
                        </label>
                    @endif
                    @if ($searchBookingTimes[2] >= 2)
                        <label>
                            <input type="radio" name="jam_booking" class="card-input-element" disabled />

                            <div class="card card-default card-input" style="color: red">
                                <div class="card-header">11:00</div>
                            </div>
                        </label>
                    @else
                        <label>
                            <input type="radio" name="jam_booking" class="card-input-element" value="11:00:00" />
                            <div class="card card-default card-input">
                                <div class="card-header">11:00</div>
                            </div>
                        </label>
                    @endif
                    @if ($searchBookingTimes[3] >= 2)
                        <label>
                            <input type="radio" name="jam_booking" class="card-input-element" disabled />

                            <div class="card card-default card-input" style="color: red">
                                <div class="card-header">12:00</div>
                            </div>
                        </label>
                    @else
                        <label>
                            <input type="radio" name="jam_booking" class="card-input-element" value="12:00:00" />
                            <div class="card card-default card-input">
                                <div class="card-header">12:00</div>
                            </div>
                        </label>
                    @endif
                    @if ($searchBookingTimes[4] >= 2)
                        <label>
                            <input type="radio" name="jam_booking" class="card-input-element" disabled />

                            <div class="card card-default card-input" style="color: red">
                                <div class="card-header">13:00</div>
                            </div>
                        </label>
                    @else
                        <label>
                            <input type="radio" name="jam_booking" class="card-input-element" value="13:00:00" />
                            <div class="card card-default card-input">
                                <div class="card-header">13:00</div>
                            </div>
                        </label>
                    @endif
                    @if ($searchBookingTimes[5] >= 2)
                        <label>
                            <input type="radio" name="jam_booking" class="card-input-element" disabled />

                            <div class="card card-default card-input" style="color: red">
                                <div class="card-header">14:00</div>
                            </div>
                        </label>
                    @else
                        <label>
                            <input type="radio" name="jam_booking" class="card-input-element" value="14:00:00" />
                            <div class="card card-default card-input">
                                <div class="card-header">14:00</div>
                            </div>
                        </label>
                    @endif
                </div>
            </div>
            <button type="submit" class="btn btn-primary" id="search">Booking Now</button>
        </div>
    </form>
@endsection

@push('jsSelect2')
    <script>
        $("#js-example-basic-single").select2({
            placeholder: "Pilih Tipe Kendaraan",
            allowClear: true,
        });
    </script>
@endpush
