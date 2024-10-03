<?php

namespace App\Http\Controllers;

use App\Models\NPD;
use App\Models\Rincian;
use App\Models\Rekening;
use Illuminate\Http\Request;

class RealisasiController extends Controller
{
    public function perubahan()
    {
        $data = NPD::where('jenis', 'anggaran')->orderBy('id', 'DESC')->get();

        $data->transform(function ($item) {
            $item->dpa = $item->detail->map(function ($item2) {
                return $item2->rincian->sum('anggaran');
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
            $item->anggaran = $item->rincian->sum('anggaran');
            $item->anggaran_perubahan = $item->rincian->sum('anggaran_perubahan');
            return $item;
        });


        $rekening = Rekening::get();
        $rincian = Rincian::get();
        return view('superadmin.perubahan.uraian', compact('data', 'rekening', 'rincian', 'detail'));
    }
}
