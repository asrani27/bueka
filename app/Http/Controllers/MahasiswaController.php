<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MahasiswaController extends Controller
{
    public function index()
    {
        $data = Mahasiswa::orderBy('id', 'DESC')->paginate(15);
        return view('admin.mahasiswa.index', compact('data'));
    }

    public function create()
    {
        return view('admin.mahasiswa.create');
    }
    public function edit($id)
    {
        $data = Mahasiswa::find($id);
        return view('admin.mahasiswa.edit', compact('data'));
    }
    public function store(Request $req)
    {
        $check = Mahasiswa::where('nama', $req->nama)->first();
        if ($check != null) {
            Session::flash('error', 'Nama mahasiswa Sudah Ada');
            return back();
        } else {
            Mahasiswa::create($req->all());
            Session::flash('success', 'Berhasil');
            return redirect('/superadmin/mahasiswa');
        }
    }
    public function update(Request $req, $id)
    {
        $data = Mahasiswa::find($id)->update($req->all());
        Session::flash('success', 'Berhasil');
        return redirect('/superadmin/mahasiswa');
    }
    public function delete($id)
    {
        $data = Mahasiswa::find($id)->delete();
        Session::flash('success', 'Berhasil');
        return redirect('/superadmin/mahasiswa');
    }
}
