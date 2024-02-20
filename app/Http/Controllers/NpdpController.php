<?php

namespace App\Http\Controllers;

use App\Models\NPD;
use Illuminate\Http\Request;

class NpdpController extends Controller
{
    public function index()
    {
        $data = NPD::where('jenis', 'pencairan')->orderBy('id', 'DESC')->paginate(20);
        return view('superadmin.npdp.index', compact('data'));
    }
    public function uraian($id)
    {
        $data = NPD::find($id);
        $detail = $data->detail->map(function ($item) {
            $item->sisa = $item->anggaran - $item->pencairan;
            return $item;
        });

        return view('superadmin.npdp.uraian', compact('data', 'detail'));
    }
}
