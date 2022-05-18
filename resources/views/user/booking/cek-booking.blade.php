@extends('layouts.master')

@section('title')
    Cek Booking Mandiri
@endsection

@section('content')
    <form action="{{ route('booking.search') }}" method="get">
        @csrf
        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" class="form-control" name="tanggal_booking">
        </div>
        <button type="submit" class="btn btn-primary" id="search">Cek</button>
    </form>
@endsection
