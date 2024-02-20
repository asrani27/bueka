<?php

namespace App\Http\Controllers;

use App\Models\NPD;
use App\Models\NpdDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SuperadminController extends Controller
{
    public function npd()
    {
        $data = NPD::where('jenis', 'anggaran')->orderBy('id', 'DESC')->paginate(20);
        return view('superadmin.npd.index', compact('data'));
    }
    public function editNpd($id)
    {
        $data = NPD::find($id);
        return view('superadmin.npd.edit', compact('data'));
    }
    public function uraianNpd($id)
    {
        $data = NPD::find($id);
        return view('superadmin.npd.uraian', compact('data'));
    }
    public function createNpd()
    {
        return view('superadmin.npd.create');
    }

    public function storeNpd(Request $req)
    {
        $param = $req->all();
        $param['user_id'] = Auth::user()->id;
        $param['jenis'] = 'anggaran';

        NPD::create($param);

        Session::flash('success', 'Berhasil disimpan');
        return redirect('/superadmin/npd');
    }

    public function updateNpd(Request $req, $id)
    {
        $param = $req->all();
        $param['user_id'] = Auth::user()->id;
        $param['jenis'] = 'anggaran';

        NPD::find($id)->update($param);

        Session::flash('success', 'Berhasil diupdate');
        return redirect('/superadmin/npd');
    }

    public function storeUraianNpd(Request $req, $id)
    {
        $n = new NpdDetail;
        $n->npd_id = $id;
        $n->kode_rekening = $req->kode_rekening;
        $n->uraian = $req->uraian;
        $n->anggaran = $req->anggaran;
        $n->save();

        Session::flash('success', 'Berhasil');
        return back();
    }
    public function deleteNpd($id)
    {

        NPD::find($id)->delete();

        Session::flash('success', 'Berhasil dihapus');
        return back();
    }
}
