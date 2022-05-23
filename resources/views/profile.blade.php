@extends('layouts.master')

@section('title')
    Profil
@endsection

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Profil</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <div class="col-lg-4 mb-4">

            <!-- Illustrations -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Foto Profil</h6>
                </div>
                <div class="card-body">
                    <div class="text-left">
                        @if (Auth::user()->photo_profile == null)
                            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4 img-profile rounded-circle" style="width: 25rem;"
                                src="{{ asset('assets/img/undraw_profile.svg') }}" alt="...">
                        @else
                            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4 img-profile rounded-circle" style="width: 25rem;"
                                src="{{ Auth::user()->photo_profile }}" alt="...">
                        @endif
                    </div>

                    <form action="{{ route('profil.update.pic') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3 form-group">
                            <label for="photo_profile" class="form-label">Update Foto Profil :</label>
                            <input type="file" class="form-control" name="photo_profile"
                                placeholder="Masukkan tipe kendaraan" id="photo_profile" aria-describedby="photo_profile"
                                required>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Foto Profil</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-4 mb-4">

            <!-- Illustrations -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Utama</h6>
                </div>
                <div class="card-body">

                    <form action="{{ route('profil.update') }}" method="post">
                        @csrf
                        <div class="mb-3 form-group">
                            <label for="name" class="form-label">Nama :</label>
                            <input type="text" class="form-control" name="name" placeholder="Masukkan nama" id="name"
                                aria-describedby="name" value="{{ Auth::user()->name }}" required>
                        </div>
                        <div class="mb-3 form-group">
                            <label for="name" class="form-label">Username :</label>
                            <input type="text" class="form-control" value="{{ Auth::user()->username }}" name="username"
                                placeholder="Masukkan username" id="username" aria-describedby="username" required>
                        </div>
                        <div class="mb-3 form-group">
                            <label for="name" class="form-label">Email :</label>
                            <input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}"
                                placeholder="Masukkan email" id="email" aria-describedby="email" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Data Utama</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-4 mb-4">

            <!-- Illustrations -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Tambahan</h6>
                </div>
                <div class="card-body">

                    <form action="{{ route('profil.update.add') }}" method="post">
                        @csrf
                        <div class="mb-3 form-group">
                            <label for="address" class="form-label">Alamat :</label>
                            <input type="text" class="form-control" name="address" value="{{ Auth::user()->address }}"
                                placeholder="Masukkan alamat" id="address" aria-describedby="address" required>
                        </div>
                        <div class="mb-3 form-group">
                            <label for="phonenumber" class="form-label">Nomor Telp. :</label>
                            <input type="text" class="form-control" name="phonenumber" placeholder="Masukkan nomor telpon"
                                id="phonenumber" aria-describedby="phonenumber" value="{{ Auth::user()->phonenumber }}"
                                required>
                        </div>
                        <div class="mb-3 form-group">
                            <label for="jeniskelamin" class="form-label">Gender :</label>
                            <select name="jeniskelamin" class="form-control" id="">
                                <option value="">- Pilih Gender -</option>
                                <option value="l" {{ Auth::user()->jeniskelamin == 'l' ? 'selected' : '' }}>Laki-laki
                                </option>
                                <option value="p" {{ Auth::user()->jeniskelamin == 'p' ? 'selected' : '' }}>Perempuan
                                </option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Data Tambahan</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-12 mb-4">

            <!-- Illustrations -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Ubah Password</h6>
                </div>
                <div class="card-body">

                    <form action="{{ route('profil.update.password') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3 form-group">
                            <label for="password_old" class="form-label">Password Lama :</label>
                            <input type="password" class="form-control" name="password_old"
                                placeholder="Masukkan password lama" id="password_old" aria-describedby="password_old"
                                required>
                        </div>
                        <div class="mb-3 form-group">
                            <label for="password" class="form-label">Password Baru :</label>
                            <input type="password" class="form-control" name="password"
                                placeholder="Masukkan password baru" id="password" aria-describedby="password" required>
                        </div>
                        <div class="mb-3 form-group">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password Baru :</label>
                            <input type="password" class="form-control" name="password_confirmation"
                                placeholder="Masukkan ulang password baru" id="password_confirmation"
                                aria-describedby="password_confirmation" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
