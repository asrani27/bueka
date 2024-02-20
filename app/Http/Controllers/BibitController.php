<?php

namespace App\Http\Controllers;

use App\Models\Bibit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BibitController extends Controller
{
    public function index()
    {
        $data = Bibit::orderBy('id', 'DESC')->paginate(15);
        return view('admin.bibit.index', compact('data'));
    }

    public function create()
    {
        return view('admin.bibit.create');
    }
    public function edit($id)
    {
        $data = Bibit::find($id);
        return view('admin.bibit.edit', compact('data'));
    }
    public function store(Request $req)
    {
        $check = Bibit::where('nama', $req->nama)->first();
        if ($check != null) {
            Session::flash('error', 'Nama Bibit Sudah Ada');
            return back();
        } else {
            Bibit::create($req->all());
            Session::flash('success', 'Berhasil');
            return redirect('/superadmin/bibit');
        }
    }
    public function update(Request $req, $id)
    {
        $data = Bibit::find($id)->update($req->all());
        Session::flash('success', 'Berhasil');
        return redirect('/superadmin/bibit');
    }
    public function delete($id)
    {
        $data = Bibit::find($id)->delete();
        Session::flash('success', 'Berhasil');
        return redirect('/superadmin/bibit');
    }
}
