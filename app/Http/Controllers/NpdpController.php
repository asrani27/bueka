<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\NPD;
use App\Models\NpdDetail;
use App\Models\NpdRincian;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Session;

class NpdpController extends Controller
{
    public function index()
    {
        $data = NPD::where('jenis', 'pencairan')->where('status', 1)->orderBy('id', 'DESC')->get();
        $data->transform(function ($item) {
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
                    $item->rincian = $item->rincian->map(function ($item2) {
                        $d = NPD::where('urut', '!=', null)->get();
                        $npd_detail_id = $d->map(function ($item3) {
                            return $item3->detail->pluck('id');
                        })->flatten()->toArray();

                        $npd_rincian = NpdRincian::whereIn('npd_detail_id', $npd_detail_id)->get();

                        $item2->akumulasi_rincian = $npd_rincian->where('kode_rincian', $item2->kode_rincian)->sum('pencairan');
                        return $item2;
                    });
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
                    $noUrut = $item->npd->urut;
                    $item->rincian = $item->rincian->map(function ($item2) use ($noUrut) {
                        $d = NPD::where('urut', '<', $noUrut)->get();
                        $npd_detail_id = $d->map(function ($item3) {
                            return $item3->detail->pluck('id');
                        })->flatten()->toArray();

                        $npd_rincian = NpdRincian::whereIn('npd_detail_id', $npd_detail_id)->get();

                        $item2->akumulasi_rincian = $npd_rincian->where('kode_rincian', $item2->kode_rincian)->sum('pencairan');
                        return $item2;
                    });
                }
                //dd($item, $akumulasi);
            }
            return $item;
        });

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
    public function batalvalidasi($id)
    {
        NPD::find($id)->update(['validasi' => 0, 'urut' => null]);
        Session::flash('success', 'Di batalkan');
        return back();
    }
    public function isinomor(Request $req)
    {
        NPD::find($req->npd_id)->update(['nomor' => $req->nomor]);
        Session::flash('success', 'Berhasil di validasi');
        return back();
    }
    public function ubahtanggal(Request $req)
    {
        NPD::find($req->npd_id)->update(['tanggal' => $req->tanggal]);
        Session::flash('success', 'Berhasil di update');
        return back();
    }
    public function delete($id)
    {
        NPD::find($id)->delete();
        Session::flash('success', 'Berhasil dihapus');
        return back();
    }
    public function pdf($id)
    {
        $data = NPD::where('id', $id)->get()->map(function ($item) {
            $item->potongan = $item->ppn + $item->pph21 + $item->pph22 + $item->pph23 + $item->pph4;
            return $item;
        })->first();

        $detail = $data->detail->map(function ($item) use ($data) {

            if ($item->npd->urut == 1) {
                $item->pencairan_saat_ini = $item->rincian->sum('pencairan');
                if (status() == 'perubahan') {
                    $item->sisa = $item->anggaran_perubahan - $item->pencairan_saat_ini;
                } else {
                    $item->sisa = $item->anggaran - $item->pencairan_saat_ini;
                }
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
                    if (status() == 'perubahan') {

                        $item->sisa = $item->anggaran_perubahan - $item->pencairan_saat_ini - $item->akumulasi;
                    } else {
                        $item->sisa = $item->anggaran - $item->pencairan_saat_ini - $item->akumulasi;
                    }
                } else {
                    dd($item->rincian);
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
                    if (status() == 'perubahan') {
                        $item->sisa = $item->anggaran_perubahan - $item->pencairan_saat_ini - $item->akumulasi;
                    } else {
                        $item->sisa = $item->anggaran - $item->pencairan_saat_ini - $item->akumulasi;
                    }
                }
            }
            return $item;
        });
        $pdf  = Pdf::loadView('superadmin.npdp.pdf_npd', compact('data', 'detail'));
        $filename = $data->user->name . '-' . Carbon::now()->format('Y-m-d-H-i-s') . '.pdf';
        return $pdf->stream($filename);
    }
}
