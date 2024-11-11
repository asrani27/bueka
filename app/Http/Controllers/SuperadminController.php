<?php

namespace App\Http\Controllers;

use App\Models\NPD;
use App\Models\Program;
use App\Models\Kegiatan;
use App\Models\Rekening;
use App\Models\NpdDetail;
use App\Models\NpdRincian;
use App\Models\Rincian;
use App\Models\Subkegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SuperadminController extends Controller
{
    public function npd()
    {
        $data = NPD::where('jenis', 'anggaran')->orderBy('id', 'DESC')->get();
        //dd($data);
        $data->transform(function ($item) {
            $item->dpa = $item->detail->sum('anggaran');
            return $item;
        });

        return view('superadmin.npd.index', compact('data'));
    }
    public function editNpd($id)
    {
        $data = NPD::find($id);
        $p = Program::get();
        $k = Kegiatan::get();
        $s = Subkegiatan::get();
        return view('superadmin.npd.edit', compact('data', 'p', 'k', 's'));
    }
    public function uraianNpd($id)
    {
        $data = NPD::find($id);
        $rekening = Rekening::get();
        $rincian = Rincian::get();
        return view('superadmin.npd.uraian', compact('data', 'rekening', 'rincian'));
    }
    public function createNpd()
    {
        $p = Program::get();
        $k = Kegiatan::get();
        $s = Subkegiatan::get();
        return view('superadmin.npd.create', compact('p', 'k', 's'));
    }

    public function storeRincian(Request $req)
    {
        if (NpdDetail::find($req->npd_detail_id)->jenis == '1') {
            $new = new NpdRincian();
            $new->npd_detail_id = $req->npd_detail_id;
            $new->kode_rincian = $req->kode_rincian;
            $new->anggaran = 0;
            $new->jenis = '1';
            $new->save();
        } else {
            $new = new NpdRincian();
            $new->npd_detail_id = $req->npd_detail_id;
            $new->kode_rincian = $req->kode_rincian;
            $new->anggaran = $req->anggaran;
            $new->jenis = $req->jenis;
            $new->save();
        }

        Session::flash('success', 'Berhasil disimpan');
        return back();
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
        $check = NpdDetail::where('npd_id', $id)->where('kode_rekening', $req->kode_rekening)->first();
        if ($check == null) {
            $n = new NpdDetail;
            $n->npd_id = $id;
            $n->kode_rekening = $req->kode_rekening;
            //$n->anggaran = $req->anggaran;
            $n->jenis = $req->jenis;
            $n->save();

            Session::flash('success', 'Berhasil');
        } else {
            Session::flash('error', 'Kode rekening sudah ada');
        }
        return back();
    }
    public function deleteNpd($id)
    {

        NPD::find($id)->delete();

        Session::flash('success', 'Berhasil dihapus');
        return back();
    }
    public function deleteRincian($id)
    {

        NpdRincian::find($id)->delete();

        Session::flash('success', 'Berhasil dihapus');
        return back();
    }
    public function deleteUraian($id, $id_rekening)
    {

        NpdDetail::find($id_rekening)->delete();

        Session::flash('success', 'Berhasil dihapus');
        return back();
    }
}
