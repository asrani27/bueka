<?php

namespace App\Http\Controllers;

use App\Models\Subkegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SubkegiatanController extends Controller
{
    public function index()
    {
        $data = Subkegiatan::paginate(15);
        return view('superadmin.subkegiatan.index', compact('data'));
    }

    public function create()
    {
        return view('superadmin.subkegiatan.create');
    }
    public function store(Request $req)
    {
        $checkKode = Subkegiatan::where('kode', $req->kode)->first();
        if ($checkKode == null) {
            $n = new Subkegiatan;
            $n->kode = $req->kode;
            $n->nama = $req->nama;
            $n->save();

            Session::flash('success', 'Berhasil Di Simpan');
            return redirect('/superadmin/subkegiatan');
        } else {
            Session::flash('error', 'Kode subkegiatan sudah ada, silahkan gunakan yang lain');
            return back();
        }
    }
    public function edit($id)
    {
        $data = Subkegiatan::where('id', $id)->first();
        return view('superadmin.subkegiatan.edit', compact('data'));
    }
    public function update(Request $req, $id)
    {
        $user = Subkegiatan::where('id', $id)->first()->update([
            'kode' => $req->kode,
            'nama' => $req->nama
        ]);
        Session::flash('success', 'Berhasil Di update');
        return redirect('/superadmin/subkegiatan');
    }
    public function delete($id)
    {
        Subkegiatan::where('id', $id)->first()->delete();
        Session::flash('success', 'Berhasil Di hapus');
        return back();
    }
}
