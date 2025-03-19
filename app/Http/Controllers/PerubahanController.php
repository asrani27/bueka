<?php

namespace App\Http\Controllers;

use App\Models\NPD;
use App\Models\Rincian;
use App\Models\Rekening;
use App\Models\NpdRincian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PerubahanController extends Controller
{
    public function perubahan()
    {
        $data = NPD::where('jenis', 'anggaran')
            ->when(tahunAktif('superadmin') !== null, fn($query) => $query->where('tahun_anggaran', tahunAktif('superadmin')))
            ->orderBy('id', 'DESC')
            ->get();

        $data->transform(function ($item) {
            $item->dpa = $item->detail->map(function ($item2) {
                return $item2->rincian->where('jenis', null)->sum('anggaran');
            })->sum();
            $item->dpa_perubahan = $item->detail->map(function ($item3) {
                return $item3->rincian->sum('anggaran_perubahan');
            })->sum();
            return $item;
        });

        return view('superadmin.perubahan.index', compact('data'));
    }
    public function uraian($id)
    {
        $data = NPD::find($id);
        $detail = $data->detail->map(function ($item) {
            $item->anggaran = $item->rincian->where('jenis', null)->sum('anggaran');
            $item->anggaran_perubahan = $item->rincian->sum('anggaran_perubahan');
            return $item;
        });


        $rekening = Rekening::get();
        $rincian = Rincian::get();
        return view('superadmin.perubahan.uraian', compact('data', 'rekening', 'rincian', 'detail'));
    }

    public function salinAnggaran($id)
    {
        $data = NPD::find($id);
        $data->detail->map(function ($item) {
            $item->rincian->map(function ($item2) {
                $item2->update([
                    'anggaran_perubahan' => $item2->anggaran
                ]);
                return $item2;
            });

            $item->update([
                'anggaran_perubahan' => $item->anggaran
            ]);

            return $item;
        });

        return back();
    }

    public function ubahAnggaran(Request $req)
    {
        $data = NpdRincian::find($req->rincian_id)->update([
            'anggaran_perubahan' => $req->anggaran_perubahan
        ]);
        Session::flash('success', 'Berhasil');
        return back();
    }
}
