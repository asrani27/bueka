<?php

use App\Models\NPD;
use Carbon\Carbon;
use App\Models\Tahun;
use App\Models\Status;

function realisasiBulanan($kode_rincian, $bulan, $tahun)
{
    return NPD::whereMonth('tanggal', $bulan)
        ->whereYear('tanggal', $tahun)
        ->with('detail.rincian')
        ->get()
        ->flatMap(function ($npd) use ($kode_rincian) {
            return $npd->detail->flatMap(function ($detail) use ($kode_rincian) {
                return $detail->rincian->where('kode_rincian', $kode_rincian);
            });
        })->sum('pencairan');
}
function penyebut($nilai)
{
    $nilai = abs($nilai);
    $huruf = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
    $temp = "";
    if ($nilai < 12) {
        $temp = " " . $huruf[$nilai];
    } elseif ($nilai < 20) {
        $temp = penyebut($nilai - 10) . " Belas";
    } elseif ($nilai < 100) {
        $temp = penyebut($nilai / 10) . " Puluh" . penyebut($nilai % 10);
    } elseif ($nilai < 200) {
        $temp = " Seratus" . penyebut($nilai - 100);
    } else if ($nilai < 1000) {
        $temp = penyebut($nilai / 100) . " Ratus" . penyebut($nilai % 100);
    } else if ($nilai < 2000) {
        $temp = " Seribu" . penyebut($nilai - 1000);
    } else if ($nilai < 1000000) {
        $temp = penyebut($nilai / 1000) . " Ribu" . penyebut($nilai % 1000);
    } else if ($nilai < 1000000000) {
        $temp = penyebut($nilai / 1000000) . " Juta" . penyebut($nilai % 1000000);
    } else if ($nilai < 1000000000000) {
        $temp = penyebut($nilai / 1000000000) . " Milyar" . penyebut(fmod($nilai, 1000000000));
    } else if ($nilai < 1000000000000000) {
        $temp = penyebut($nilai / 1000000000000) . " Trilyun" . penyebut(fmod($nilai, 1000000000000));
    }
    return $temp;
}
function status()
{
    $year = Carbon::now()->format('Y');
    $month = strtolower(Carbon::now()->translatedFormat('F'));
    $result = Status::where('tahun', $year)->first()[$month];
    return $result;
}
function tahunAktif()
{
    $tahun = Tahun::where('is_aktif', 1)->first();
    if ($tahun == null) {
        $result = null;
    } else {
        $result = $tahun->tahun;
    }
    return $result;
}
function terbilang($nilai)
{
    if ($nilai < 0) {
        $hasil = "minus " . trim(penyebut($nilai));
    } else {
        $hasil = trim(penyebut($nilai));
    }
    echo $hasil;
}
