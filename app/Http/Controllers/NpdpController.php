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

        // $detail2 = [];
        // foreach ($detail->toArray() as $key => $item) {
        //     foreach ($item['rincian'] as $key2 => $rincian) {
        //         $rincian['akumulasi_rincian'] = 23443;
        //     }
        // }
        //dd($detail->toArray());
        //dd($detail, $data);
        return view('superadmin.npdp.uraian', compact('data', 'detail'));
    }
    public function validasi($id)
    {
        $data = NPD::where('jenis', 'pencairan')->max('urut');
        if ($data == null) {
            NPD::find($id)->update(['validasi' => 1, 'urut' => 1]);
            Session::flash('success', 'Berhasil di validasi');
        } else {
            NPD::find($id)->update(['validasi' => 1, 'urut' => $data + 1]);
            Session::flash('success', 'Berhasil di validasi');
        }
        return back();
    }
    public function isinomor(Request $req)
    {
        NPD::find($req->npd_id)->update(['nomor' => $req->nomor]);
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
