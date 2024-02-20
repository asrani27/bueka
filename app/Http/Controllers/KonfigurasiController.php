<?php

namespace App\Http\Controllers;

use App\Models\Konfigurasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class KonfigurasiController extends Controller
{
    public function beranda()
    {
        $data = Konfigurasi::first();
        return view('admin.konfigurasi.beranda', compact('data'));
    }
    public function updateBeranda(Request $req)
    {
        $param = $req->all();

        $validator = Validator::make($req->all(), [
            'gambar1'  => 'mimes:jpg,jpeg,png|max:2048',
            'gambar2'  => 'mimes:jpg,jpeg,png|max:2048',
            'gambar3'  => 'mimes:jpg,jpeg,png|max:2048',
            'partner1'  => 'mimes:jpg,jpeg,png|max:2048',
            'partner2'  => 'mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($validator->fails()) {
            $req->flash();
            Session::flash('error', 'File harus gambar dan Maks 2MB');
            return back();
        }

        $path = public_path('storage') . '/image';

        $data = Konfigurasi::first();
        if ($req->gambar1 == null) {
            $param['gambar1'] = $data->gambar1;
        } else {
            $gambar1 = $req->file('gambar1');
            $ext = $req->gambar1->getClientOriginalExtension();
            $param['gambar1'] = 'gambar1' . uniqid() . '.' . $ext;
            $gambar1->move($path, $param['gambar1']);
        }
        if ($req->gambar2 == null) {
            $param['gambar2'] = $data->gambar2;
        } else {
            $gambar2 = $req->file('gambar2');
            $ext = $req->gambar2->getClientOriginalExtension();
            $param['gambar2'] = 'gambar2' . uniqid() . '.' . $ext;
            $gambar2->move($path, $param['gambar2']);
        }
        if ($req->gambar3 == null) {
            $param['gambar3'] = $data->gambar3;
        } else {
            $gambar3 = $req->file('gambar3');
            $ext = $req->gambar3->getClientOriginalExtension();
            $param['gambar3'] = 'gambar3' . uniqid() . '.' . $ext;
            $gambar3->move($path, $param['gambar3']);
        }
        if ($req->partner1 == null) {
            $param['partner1'] = $data->partner1;
        } else {
            $partner1 = $req->file('partner1');
            $ext = $req->partner1->getClientOriginalExtension();
            $param['partner1'] = 'partner1' . uniqid() . '.' . $ext;
            $partner1->move($path, $param['partner1']);
        }
        if ($req->partner2 == null) {
            $param['partner2'] = $data->partner2;
        } else {
            $partner2 = $req->file('partner2');
            $ext = $req->partner2->getClientOriginalExtension();
            $param['partner2'] = 'partner2' . uniqid() . '.' . $ext;
            $partner2->move($path, $param['partner2']);
        }

        $update = Konfigurasi::first()->update($param);
        Session::flash('success', 'Berhasil Di Update');
        return back();
    }
}
