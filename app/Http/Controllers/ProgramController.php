<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProgramController extends Controller
{
    public function index()
    {
        $data = Program::paginate(15);
        return view('superadmin.program.index', compact('data'));
    }

    public function create()
    {
        return view('superadmin.program.create');
    }
    public function store(Request $req)
    {
        $checkKode = Program::where('kode', $req->kode)->first();
        if ($checkKode == null) {
            $n = new Program;
            $n->kode = $req->kode;
            $n->nama = $req->nama;
            $n->save();

            Session::flash('success', 'Berhasil Di Simpan');
            return redirect('/superadmin/program');
        } else {
            Session::flash('error', 'Kode Program sudah ada, silahkan gunakan yang lain');
            return back();
        }
    }
    public function edit($id)
    {
        $data = Program::find($id);
        return view('superadmin.program.edit', compact('data'));
    }
    public function update(Request $req, $id)
    {
        $user = Program::find($id)->update([
            'kode' => $req->kode,
            'nama' => $req->nama
        ]);
        Session::flash('success', 'Berhasil Di update');
        return redirect('/superadmin/program');
    }
    public function delete($id)
    {
        Program::find($id)->delete();
        Session::flash('success', 'Berhasil Di hapus');
        return back();
    }
}
