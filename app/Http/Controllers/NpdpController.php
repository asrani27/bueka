<?php

namespace App\Http\Controllers;

use App\Models\NPD;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class NpdpController extends Controller
{
    public function index()
    {
        $data = NPD::where('jenis', 'pencairan')->where('status', 1)->orderBy('id', 'DESC')->paginate(20);
        $data->getCollection()->transform(function ($item) {
            $item->jumlah_dana = $item->detail->map(function ($item2) {
                $item2->pencairan_saat_ini = $item2->rincian->sum('pencairan');
                return $item2;
            })->sum('pencairan_saat_ini');
            return $item;
        });

        return view('superadmin.npdp.index', compact('data'));
    }
    public function uraian($id)
    {
        $data = NPD::find($id);
        $detail = $data->detail->map(function ($item) {
            $item->pencairan_saat_ini = $item->rincian->sum('pencairan');
            $item->sisa = $item->anggaran - $item->pencairan_saat_ini;
            return $item;
        });
        return view('superadmin.npdp.uraian', compact('data', 'detail'));
    }
    public function validaso($id)
    {
        NPD::find($id)->update(['validasi' => 1]);
        Session::flash('success', 'Berhasil di validasi');
        return back();
    }
    public function delete($id)
    {
        NPD::find($id)->delete();
        Session::flash('success', 'Berhasil dihapus');
        return back();
    }
}
