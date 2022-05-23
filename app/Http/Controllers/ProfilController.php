<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProfilController extends Controller
{
    private $baseurl = 'http://127.0.0.1:8000';
    public function showProfil()
    {
        $profil = User::find(Auth::user()->id);
        return view('profile', compact('profil'));
    }
    public function updateProfilPic(Request $request)
    {
        $profil = User::find(Auth::user()->id);
        if ($request->hasFile('photo_profile')) {
            $fileNameGambarSparepart = 'photo_profile_' . uniqid() . strtolower(Str::random(10)) . '.' . $request->photo_profile->extension();
            $request->file('photo_profile')->move('storage/photo-profile/', $fileNameGambarSparepart);

            $profil->forceFill([
                'photo_profile' => $this->baseurl . '/storage/photo-profile/' . $fileNameGambarSparepart
            ])->save();
            return redirect('profile');
        }
    }

    public function updateProfil(Request $request)
    {
        $profil = User::find(Auth::user()->id);
        $profil->forceFill([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email
        ])->save();
        return redirect('profile');
    }

    public function updateProfilAdd(Request $request)
    {
        $profil = User::find(Auth::user()->id);
        $profil->forceFill([
            'address' => $request->address,
            'phonenumber' => $request->phonenumber,
            'jeniskelamin' => $request->jeniskelamin
        ])->save();
        return redirect('profile');
    }

    public function updateProfilPassword(Request $request)
    {
        $profil = User::find(Auth::user()->id);
        if (Hash::check(request('password_old'), $profil->password)) {
            $profil->forceFill([
                'password' => bcrypt($request->password)
            ])->save();
            return redirect('profile');
        }
    }
}