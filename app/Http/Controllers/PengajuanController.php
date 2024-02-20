<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Bibit;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use App\Models\Detail_Pengajuan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PengajuanController extends Controller
{
    public function admin_index()
    {
        $pengajuan = Pengajuan::where('status', 1)->paginate(10);
        //$bibit = Bibit::where('stok', '!=', 0)->get();
        return view('admin.pengajuan.index', compact('pengajuan'));
    }
    public function validasi(Request $req)
    {
        if ($req->button == "setuju") {
            $pengajuan = Pengajuan::find($req->pengajuan_id)->update(['status' => 2, 'tgl_validasi' => Carbon::now()->format('Y-m-d')]);
            Session::flash('success', 'DISETUJUI');
            return back();
        } else {
            $pengajuan = Pengajuan::find($req->pengajuan_id)->update(['status' => 3, 'tgl_validasi' => Carbon::now()->format('Y-m-d')]);
            Session::flash('success', 'DITOLAK');
            return back();
        }
    }

    public function index()
    {
        $pengajuan = Pengajuan::where('user_id', Auth::user()->id)->paginate(10);
        $bibit = Bibit::where('stok', '!=', 0)->get();
        return view('pemohon.pengajuan.index', compact('pengajuan', 'bibit'));
    }
    public function create()
    {
        return view('pemohon.pengajuan.create');
    }

    public function store(Request $req)
    {
        $param = $req->all();
        $param['user_id'] = Auth::user()->id;
        $param['tanggal'] = Carbon::now()->format('Y-m-d');

        Pengajuan::create($param);

        Session::flash('success', 'Berhasil disimpan');
        return redirect('/pemohon/pengajuan');
    }

    public function delete($id)
    {
        //kembalikan stok
        $data = Pengajuan::find($id)->detail;
        foreach ($data as $item) {
            $u = Bibit::find($item->bibit_id);
            $u->stok = $u->stok + $item->jumlah;
            $u->save();
        }
        Pengajuan::find($id)->delete();
        Session::flash('success', 'Berhasil dihapus');
        return back();
    }

    public function edit($id)
    {
        $data = Pengajuan::find($id);
        return view('pemohon.pengajuan.edit', compact('data'));
    }
    public function ajukan(Request $req, $id)
    {

        $data = Pengajuan::find($id)->detail;
        if ($data->count() == 0) {

            Session::flash('error', 'harap isi bibit yang ingin diajukan');
            return back();
        } else {
            Pengajuan::find($id)->update([
                'status' => 1
            ]);
            Session::flash('success', 'Berhasil dikirim');
            return redirect('/pemohon/pengajuan');
        }
    }
    public function storeBibit(Request $req)
    {
        $bibit = Bibit::find($req->bibit_id);
        if ($req->jumlah > $bibit->stok) {
            Session::flash('error', 'Stok Tidak Cukup');
            return back();
        } else {
            //simpan ke detail
            $bibit->update([
                'stok' => $bibit->stok - $req->jumlah
            ]);
            $check = Detail_Pengajuan::where('pengajuan_id', $req->pengajuan_id)->where('bibit_id', $req->bibit_id)->first();
            if ($check != null) {
                $check->update([
                    'jumlah' => $check->jumlah + $req->jumlah
                ]);
                Session::flash('success', 'Berhasil disimpan');
                return back();
            } else {
                $n = new Detail_Pengajuan;
                $n->pengajuan_id = $req->pengajuan_id;
                $n->bibit_id = $req->bibit_id;
                $n->jumlah = $req->jumlah;
                $n->save();
                Session::flash('success', 'Berhasil disimpan');
                return back();
            }
        }
    }
}
