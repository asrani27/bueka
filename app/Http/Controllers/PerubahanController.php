<?php

namespace App\Http\Controllers;

use App\Models\NPD;
use App\Models\Rincian;
use App\Models\Rekening;
use Illuminate\Http\Request;

class PerubahanController extends Controller
{
    public function perubahan()
    {
        $data = NPD::where('jenis', 'anggaran')->orderBy('id', 'DESC')->get();

        $data->transform(function ($item) {
            $item->dpa = $item->detail->sum('anggaran');
            $item->dpa_perubahan = $item->detail->sum('anggaran_perubahan');
            return $item;
        });

        return view('superadmin.perubahan.index', compact('data'));
    }
    public function uraian($id)
    {
        $data = NPD::find($id);
        $rekening = Rekening::get();
        $rincian = Rincian::get();
        return view('superadmin.perubahan.uraian', compact('data', 'rekening', 'rincian'));
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
}
