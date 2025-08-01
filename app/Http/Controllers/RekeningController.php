<?php

namespace App\Http\Controllers;

use App\Models\Rekening;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RekeningController extends Controller
{
    public function index()
    {
        $data = Rekening::paginate(15);
        return view('superadmin.rekening.index', compact('data'));
    }

    public function create()
    {
        return view('superadmin.rekening.create');
    }
    public function store(Request $req)
    {
        $checkKode = Rekening::where('kode', $req->kode)->first();
        if ($checkKode == null) {
            $n = new Rekening;
            $n->kode = $req->kode;
            $n->nama = $req->nama;
            $n->save();

            Session::flash('success', 'Berhasil Di Simpan');
            return redirect('/superadmin/rekening');
        } else {
            Session::flash('error', 'Kode rekening sudah ada, silahkan gunakan yang lain');
            return back();
        }
    }
    public function edit($id)
    {
        $data = Rekening::find($id);

        return view('superadmin.rekening.edit', compact('data'));
    }
    public function update(Request $req, $id)
    {
        $user = Rekening::find($id)->update([
            'kode' => $req->kode,
            'nama' => $req->nama
        ]);
        Session::flash('success', 'Berhasil Di update');
        return redirect('/superadmin/rekening');
    }
    public function delete($id)
    {
        Rekening::find($id)->delete();
        Session::flash('success', 'Berhasil Di hapus');
        return back();
    }
}
