<?php

namespace App\Http\Controllers;

use captcha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use DerekCodes\TurnstileLaravel\TurnstileLaravel;

class LoginController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            if (Auth::user()->hasRole('superadmin')) {
                return redirect('superadmin');
            } elseif (Auth::user()->hasRole('admin')) {
                return redirect('admin');
            }
        }

        return view('login');
    }

    public function reloadCaptcha()
    {
        return response()->json(['captcha' => captcha_img()]);
    }

    public function login(Request $req)
    {
        if ($req->get('cf-turnstile-response') == null) {
            Session::flash('warning', 'Checklist Captcha');
            return back();
        } else {
            $turnstile = new TurnstileLaravel;
            $response = $turnstile->validate($req->get('cf-turnstile-response'));
            if ($response['status'] == true) {
                $remember = $req->remember ? true : false;
                $credential = $req->only('username', 'password');

                if (Auth::attempt($credential, $remember)) {

                    if (Auth::user()->hasRole('superadmin')) {
                        Session::flash('success', 'Selamat Datang');
                        return redirect('superadmin');
                    }
                    if (Auth::user()->hasRole('admin')) {
                        Session::flash('success', 'Selamat Datang');
                        return redirect('admin');
                    }
                } else {
                    Session::flash('error', 'username/password salah');
                    $req->flash();
                    return back();
                }
            } else {
                Session::flash('warning', 'Captcha Failed');
                return back();
            }
        }
    }
}
