<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{
    public function beranda()
    {
        if (Auth::check()) {
            if (Auth::user()->hasRole('superadmin')) {
                return redirect('superadmin');
            } elseif (Auth::user()->hasRole('pemohon')) {
                return redirect('pemohon');
            }
        }
        return view('welcome');
    }
    public function fitur()
    {
        return view('fitur');
    }
    public function tim()
    {
        return view('tim');
    }
    public function partner()
    {
        return view('partner');
    }
    public function hubungikami()
    {
        return view('hubungikami');
    }
}
