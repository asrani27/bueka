<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DosenController extends Controller
{
    public function index()
    {
        $data = Dosen::orderBy('id', 'DESC')->paginate(15);
        return view('admin.dosen.index', compact('data'));
    }

    public function create()
    {
        return view('admin.dosen.create');
    }
    public function edit($id)
    {
        $data = Dosen::find($id);
        return view('admin.dosen.edit', compact('data'));
    }
    public function store(Request $req)
    {
        $check = Dosen::where('nama', $req->nama)->first();
        if ($check != null) {
            Session::flash('error', 'Nama dosen Sudah Ada');
            return back();
        } else {
            Dosen::create($req->all());
            Session::flash('success', 'Berhasil');
            return redirect('/superadmin/dosen');
        }
    }
    public function update(Request $req, $id)
    {
        $data = Dosen::find($id)->update($req->all());
        Session::flash('success', 'Berhasil');
        return redirect('/superadmin/dosen');
    }
    public function delete($id)
    {
        $data = Dosen::find($id)->delete();
        Session::flash('success', 'Berhasil');
        return redirect('/superadmin/dosen');
    }
}
