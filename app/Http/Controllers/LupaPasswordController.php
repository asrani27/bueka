<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LupaPasswordController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            if (Auth::user()->hasRole('superadmin')) {
                return redirect('superadmin');
            } elseif (Auth::user()->hasRole('pemohon')) {
                return redirect('pemohon');
            }
        }
        return view('lupa_password');
    }
}
