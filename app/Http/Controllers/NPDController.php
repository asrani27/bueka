<?php

namespace App\Http\Controllers;

use App\Models\NPD;
use App\Models\NpdDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class NPDController extends Controller
{
    public function index()
    {
        $data = NPD::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->paginate(20);
        return view('admin.npd.index', compact('data'));
    }
    public function edit($id)
    {
        $data = NPD::find($id);
        return view('admin.npd.edit', compact('data'));
    }
    public function uraian($id)
    {
        $data = NPD::find($id);
        $detail = $data->detail->map(function ($item) {
            $item->sisa = $item->anggaran - $item->pencairan;
            return $item;
        });

        return view('admin.npd.uraian', compact('data', 'detail'));
    }
    public function create()
    {
        $subkegiatan = NPD::where('jenis', 'anggaran')->get();
        return view('admin.npd.create', compact('subkegiatan'));
    }

    public function store(Request $req)
    {
        $npd = NPD::find($req->npd_id);

        $param = $npd->toArray();
        $param['user_id'] = Auth::user()->id;
        $param['jenis'] = 'pencairan';

        $n = NPD::create($param);

        foreach ($npd->detail as $key => $item) {
            $d = new NpdDetail;
            $d->npd_id = $n->id;
            $d->kode_rekening = $item->kode_rekening;
            $d->uraian = $item->uraian;
            $d->anggaran = $item->anggaran;
            $d->save();
        }

        Session::flash('success', 'Berhasil disimpan');
        return redirect('/admin/npd');
    }
    public function delete($id)
    {

        NPD::find($id)->delete();

        Session::flash('success', 'Berhasil dihapus');
        return back();
    }

    public function storePencairan(Request $req, $id)
    {
        $find = NpdDetail::find($req->npd_detail_id);
        $find->pencairan = $req->pencairan_saat_ini;
        $find->save();

        Session::flash('success', 'Berhasil disimpan');
        return back();
    }
}
