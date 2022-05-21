<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    public function showProfil()
    {
        $profil = User::find(Auth::user()->id);
        return view('profile', compact('profil'));
    }
}