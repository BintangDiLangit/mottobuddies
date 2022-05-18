@extends('layouts.master')

@section('title')
    Cek Tipe
@endsection

@section('content')
    <form action="{{ route('booking.cek.tipe') }}" method="get">
        @csrf
        <div class="mb-3">
            <label for="tipeKendaraan" class="form-label">Tipe Kendaraan</label>
            <select class="form-control js-example-basic-single" id="js-example-basic-single" name="tipe_kendaraan_id">
                <option value="">- Pilih Tipe Kendaraan -</option>
                @foreach ($tipeKendaraansUser as $item)
                    <option value="{{ $item->id }}">
                        {{ $item->jenis_kendaraan == 'mobil' ? 'Mobil' : 'Motor' }} -
                        {{ $item->nama_tipe_kendaraan }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Cari</button>
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
