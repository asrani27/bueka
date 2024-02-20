<?php

namespace App\Http\Controllers;

use App\Models\Bibit;
use App\Models\Pengajuan;
use App\Models\User;
use Illuminate\Http\Request;

class LaporanController extends Controller
{

    public function index()
    {
        return view('admin.laporan.index');
    }
    public function user()
    {
        $data = User::get();
        return view('admin.laporan.user', compact('data'));
    }

    public function bibit()
    {
        $data = Bibit::get();
        return view('admin.laporan.bibit', compact('data'));
    }

    public function stok()
    {
        $data = Bibit::get();
        return view('admin.laporan.stok', compact('data'));
    }

    public function pengajuan()
    {
        $data = Pengajuan::get();
        return view('admin.laporan.pengajuan', compact('data'));
    }

    public function validasi()
    {
        $data = Pengajuan::where('status', 2)->get();
        return view('admin.laporan.validasi', compact('data'));
    }
    public function periode(Request $req)
    {
        $from = $req->mulai;
        $to = $req->sampai;

        if ($req->jenis == 'pengajuan') {
            $data = Pengajuan::whereBetween('tanggal', [$from, $to])->get();
            return view('admin.laporan.pengajuanp', compact('data', 'from', 'to'));
        }
        if ($req->jenis == 'validasi') {
            $data = Pengajuan::whereBetween('tanggal', [$from, $to])->where('status', 2)->get();
            return view('admin.laporan.validasip', compact('data', 'from', 'to'));
        }
        if ($req->jenis == 'serahterima') {
            $data = Pengajuan::whereBetween('tanggal', [$from, $to])->where('tgl_serah_terima', '!=', null)->get();
            return view('admin.laporan.serahterimap', compact('data', 'from', 'to'));
        }
    }
    public function serahterima()
    {
        $data = Pengajuan::where('tgl_serah_terima', '!=', null)->get();
        return view('admin.laporan.serahterima', compact('data'));
    }
}
