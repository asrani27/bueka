<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use Illuminate\Http\Request;

class ValidasiController extends Controller
{
    public function index()
    {
        $data = Pengajuan::where('status', 2)->paginate(10);
        return view('admin.validasi.index', compact('data'));
    }
}
