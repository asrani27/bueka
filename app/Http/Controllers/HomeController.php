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
        $tahun = Tahun::where('roles', 'superadmin')->get();
        return view('superadmin.home', compact('tahun'));
    }

    public function simpantahun(Request $req)
    {
        // Nonaktifkan semua tahun
        Tahun::query()->where('roles', 'superadmin')->update(['is_aktif' => null]);

        // Jika ada tahun yang dipilih, aktifkan

        if ($req->tahun !== null) {
            if ($tahun = Tahun::find($req->tahun)) {
                $tahun->update(['is_aktif' => 1]);
            }
        }
        Session::flash('success', 'Data Di tampilkan');
        return back();
    }
    public function admin()
    {
        $tahun = Tahun::where('roles', 'admin')->get();
        return view('admin.home', compact('tahun'));
    }
    public function simpantahun2(Request $req)
    {
        // Nonaktifkan semua tahun
        Tahun::query()->where('roles', 'admin')->update(['is_aktif' => null]);

        // Jika ada tahun yang dipilih, aktifkan

        if ($req->tahun !== null) {
            if ($tahun = Tahun::find($req->tahun)) {
                $tahun->update(['is_aktif' => 1]);
            }
        }
        Session::flash('success', 'Data Di tampilkan');
        return back();
    }
}
