<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    public function index()
    {
        $data = Auth::user();
        return view('pemohon.profil.index', compact('data'));
    }
}
