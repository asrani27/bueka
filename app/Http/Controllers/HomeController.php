<?php

namespace App\Http\Controllers;

use App\Models\Lurah;
use App\Models\Tahun;
use App\Models\Tpermohonan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function superadmin()
    {
        $tahun = Tahun::get();
        return view('superadmin.home', compact('tahun'));
    }

    public function simpantahun(Request $req)
    {
        // Nonaktifkan semua tahun
        Tahun::query()->update(['is_aktif' => null]);

        // Jika ada tahun yang dipilih, aktifkan
        if ($req->tahun !== null) {
            if ($tahun = Tahun::where('tahun', $req->tahun)->first()) {
                $tahun->update(['is_aktif' => 1]);
            }
        }

        return back();
    }
    public function admin()
    {
        return view('admin.home');
    }
}
