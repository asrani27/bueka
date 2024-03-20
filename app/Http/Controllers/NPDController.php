<?php

namespace App\Http\Controllers;

use App\Models\NPD;
use App\Models\NpdDetail;
use App\Models\NpdRincian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class NPDController extends Controller
{
    public function index()
    {
        $data = NPD::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->paginate(20);
        $data->getCollection()->transform(function ($item) {
            $item->jumlah_dana = $item->detail->map(function ($item2) {
                $item2->pencairan_saat_ini = $item2->rincian->sum('pencairan');
                return $item2;
            })->sum('pencairan_saat_ini');
            return $item;
        });


        return view('admin.npd.index', compact('data'));
    }
    public function edit($id)
    {
        $data = NPD::find($id);
        return view('admin.npd.edit', compact('data'));
    }
    public function uraian($id)
    {

        $data = NPD::where('id', $id)->get()->map(function ($item) {
            $item->potongan = $item->ppn + $item->pph21 + $item->pph22 + $item->pph23 + $item->pph4;
            return $item;
        })->first();

        $detail = $data->detail->map(function ($item) use ($data) {
            if ($item->npd->urut == 1) {
                $item->pencairan_saat_ini = $item->rincian->sum('pencairan');
                $item->sisa = $item->anggaran - $item->pencairan_saat_ini;
                $item->akumulasi = 0;
                $item->rincian = $item->rincian->map(function ($item2) {
                    $item2->akumulasi_rincian = 0;
                    return $item2;
                });
            } else {
                if ($item->npd->urut == null) {

                    $akumulasi = NPD::where('tahun_anggaran', $data->tahun_anggaran)->where('kode_subkegiatan', $data->kode_subkegiatan)->where('urut', '!=', null)->get();
                    $akumulasi->map(function ($item) {
                        $item->akumulasi = $item->detail->map(function ($item2) {
                            $item2->akumulasi = $item2->rincian->sum('pencairan');
                            return $item2;
                        });
                        return $item;
                    });

                    $da = $akumulasi->map(function ($item) {
                        return $item->akumulasi;
                    })->flatten();

                    $item->akumulasi = $da->where('kode_rekening', $item->kode_rekening)->sum('akumulasi');
                    $item->pencairan_saat_ini = $item->rincian->sum('pencairan');
                    $item->sisa = $item->anggaran - $item->pencairan_saat_ini - $item->akumulasi;
                } else {
                    $akumulasi = NPD::where('tahun_anggaran', $data->tahun_anggaran)->where('kode_subkegiatan', $item->npd->kode_subkegiatan)->where('urut', '<', $item->npd->urut)->get();
                    $akumulasi->map(function ($item) {
                        $item->akumulasi = $item->detail->map(function ($item2) {
                            $item2->akumulasi = $item2->rincian->sum('pencairan');
                            return $item2;
                        });
                        return $item;
                    });

                    $da = $akumulasi->map(function ($item) {
                        return $item->akumulasi;
                    })->flatten();

                    $item->akumulasi = $da->where('kode_rekening', $item->kode_rekening)->sum('akumulasi');
                    $item->pencairan_saat_ini = $item->rincian->sum('pencairan');
                    $item->sisa = $item->anggaran - $item->pencairan_saat_ini - $item->akumulasi;
                }
                //dd($item, $akumulasi);
            }
            return $item;
        });

        // $data = NPD::where('id', $id)->get()->map(function ($item) {
        //     $item->potongan = $item->ppn + $item->pph21 + $item->pph22 + $item->pph23 + $item->pph4;
        //     return $item;
        // })->first();

        // $detail = $data->detail->map(function ($item) {
        //     $item->pencairan_saat_ini = $item->rincian->sum('pencairan');
        //     $item->sisa = $item->anggaran - $item->pencairan_saat_ini;
        //     return $item;
        // });
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
            $d->anggaran = $item->anggaran;
            $d->save();

            foreach ($item->rincian as $key2 => $item2) {
                $r = new NpdRincian;
                $r->npd_detail_id = $d->id;
                $r->kode_rincian = $item2->kode_rincian;
                $r->anggaran = $item2->anggaran;
                $r->save();
            }
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
    public function storePencairanRincian(Request $req, $id)
    {
        $find = NpdRincian::find($req->npd_rincian_id);
        if ($find->anggaran < (int)$req->pencairan_saat_ini) {

            Session::flash('info', 'Gagal disimpan, anggaran kurang/realisasi melebihi');
            return back();
        } else {

            $find->pencairan = $req->pencairan_saat_ini;
            $find->save();

            Session::flash('success', 'Berhasil disimpan');
            return back();
        }
    }
    public function kirim($id)
    {
        NPD::find($id)->update([
            'status' => 1,
        ]);
        Session::flash('success', 'Berhasil dikirim');
        return back();
    }


    public function ppn(Request $req, $id)
    {
        $data = NPD::find($id);
        $data->update([
            'ppn' => $req->ppn,
        ]);
        Session::flash('success', 'Berhasil disimpan');
        return back();
    }
    public function pph21(Request $req, $id)
    {
        $data = NPD::find($id);
        $data->update([
            'pph21' => $req->pph21,
        ]);
        Session::flash('success', 'Berhasil disimpan');
        return back();
    }
    public function pph22(Request $req, $id)
    {
        $data = NPD::find($id);
        $data->update([
            'pph22' => $req->pph22,
        ]);
        Session::flash('success', 'Berhasil disimpan');
        return back();
    }
    public function pph23(Request $req, $id)
    {
        $data = NPD::find($id);
        $data->update([
            'pph23' => $req->pph23,
        ]);
        Session::flash('success', 'Berhasil disimpan');
        return back();
    }
    public function pph4(Request $req, $id)
    {
        $data = NPD::find($id);
        $data->update([
            'pph4' => $req->pph4,
        ]);
        Session::flash('success', 'Berhasil disimpan');
        return back();
    }
}
