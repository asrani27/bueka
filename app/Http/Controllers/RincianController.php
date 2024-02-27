<?php

namespace App\Http\Controllers;

use App\Models\Rincian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RincianController extends Controller
{
    public function index()
    {
        $data = Rincian::paginate(15);
        return view('superadmin.rincian.index', compact('data'));
    }

    public function create()
    {
        return view('superadmin.rincian.create');
    }
    public function store(Request $req)
    {
        $checkKode = Rincian::where('kode', $req->kode)->first();
        if ($checkKode == null) {
            $n = new Rincian;
            $n->kode = $req->kode;
            $n->nama = $req->nama;
            $n->save();

            Session::flash('success', 'Berhasil Di Simpan');
            return redirect('/superadmin/rincian');
        } else {
            Session::flash('error', 'Kode rincian sudah ada, silahkan gunakan yang lain');
            return back();
        }
    }
    public function edit($id)
    {
        $data = Rincian::find($id);
        return view('superadmin.rincian.edit', compact('data'));
    }
    public function update(Request $req, $id)
    {
        $user = Rincian::find($id)->update([
            'kode' => $req->kode,
            'nama' => $req->nama
        ]);
        Session::flash('success', 'Berhasil Di update');
        return redirect('/superadmin/rincian');
    }
    public function delete($id)
    {
        dd(Rincian::find($id));
        Rincian::find($id)->delete();
        Session::flash('success', 'Berhasil Di hapus');
        return back();
    }
}
