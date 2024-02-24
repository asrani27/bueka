<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    public function index()
    {
        $data = Kegiatan::paginate(15);
        return view('superadmin.kegiatan.index', compact('data'));
    }

    public function create()
    {
        return view('superadmin.kegiatan.create');
    }
    public function store(Request $req)
    {
        $checkKode = Kegiatan::where('kode', $req->kode)->first();
        if ($checkKode == null) {
            $n = new Kegiatan;
            $n->kode = $req->kode;
            $n->nama = $req->nama;
            $n->save();

            Session::flash('success', 'Berhasil Di Simpan');
            return redirect('/superadmin/kegiatan');
        } else {
            Session::flash('error', 'Kode kegiatan sudah ada, silahkan gunakan yang lain');
            return back();
        }
    }
    public function edit($id)
    {
        $data = Kegiatan::find($id);
        return view('superadmin.kegiatan.edit', compact('data'));
    }
    public function update(Request $req, $id)
    {
        $user = Kegiatan::find($id)->update([
            'kode' => $req->kode,
            'nama' => $req->nama
        ]);
        Session::flash('success', 'Berhasil Di update');
        return redirect('/superadmin/kegiatan');
    }
    public function delete($id)
    {
        Kegiatan::find($id)->delete();
        Session::flash('success', 'Berhasil Di hapus');
        return back();
    }
}
