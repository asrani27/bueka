<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class GantiPasswordController extends Controller
{
    public function index()
    {
        return view('superadmin.gp');
    }

    public function update(Request $req)
    {
        if ($req->password1 != $req->password2) {
            Session::flash('error', 'Password Tidak Sama');
        } else {
            Auth::user()->update([
                'password' => bcrypt($req->password1)
            ]);
            Session::flash('success', 'Berhasil Di Update');
        }
        return back();
    }
}
