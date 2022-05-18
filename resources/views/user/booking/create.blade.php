@extends('layouts.master')

@section('title')
    Buat Booking
@endsection

@section('content')
    <form action="{{ route('booking.store') }}" method="post">
        @csrf
        <div class="mb-3">
            <label for="jenisKendaraan" class="form-label">Jenis Kendaraan :
                {{ $tipe->tipeKendaraan->jenis_kendaraan == 'mobil' ? 'Mobil' : 'Motor' }}</label>
            <input type="text" value="{{ $tipe->tipe_kendaraan_id }}" name="tipe_kendaraan_id" hidden>
        </div>
        <div class="mb-3">
            <label for="tipeKendaraan" class="form-label">Tipe Kendaraan :
                {{ $tipe->tipeKendaraan->nama_tipe_kendaraan }}</label>
        </div>

        <div class="mb-3">
            <label for="serviceTerakhir" class="form-label">Service Terakhir :
                {{ date('H:i d-M-Y', strtotime($tipe->waktu_booking)) }}</label>
        </div>


        <div class="mb-3">
            <label for="serviceTerakhir" class="form-label">Rekomendasi Booking :
                {{ date('H:i d-M-Y', strtotime($recommendation)) }}</label>

            <input type="text" value="{{ date('Y-m-d H:i:s', strtotime($recommendation)) }}" name="rekom_booking" hidden>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection

@push('jsSelect2')
    <script>
        $("#js-example-basic-single").select2({
            placeholder: "Pilih Tipe",
            allowClear: true,
        });
    </script>
@endpush
