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
    public function setAnggaranPerubahan($id)
    {
        //uraian dari data murni ke data perubahan
        $npd = NPD::with('detail.rincian')->find($id);
        $perubahan = NPD::where('tahun_anggaran', $npd->tahun_anggaran)->where('kode_subkegiatan', $npd->kode_subkegiatan)->where('jenis', 'anggaran')->first();

        if (!$npd) {
            return redirect()->back()->with('error', 'Data NPD tidak ditemukan.');
        }

        //diff dari murni ke perubahan
        foreach ($perubahan->detail as $details) {

            $checkNpdDetail = $npd->detail->where('kode_rekening', $details->kode_rekening)->first();
            if ($checkNpdDetail === null) {
                $npdDetail = new NpdDetail();
                $npdDetail->npd_id = $npd->id;
                $npdDetail->kode_rekening = $details->kode_rekening;
                $npdDetail->jenis = $details->jenis;
                $npdDetail->save();
            }

            $npdDetailMurni = NpdDetail::where('npd_id', $npd->id)->where('kode_rekening', $details->kode_rekening)->first()->rincian;

            foreach ($details->rincian as $rinci) {
                $checkRincian = $npdDetailMurni->where('kode_rincian', $rinci->kode_rincian)->first();
                if ($checkRincian === null) {
                    //tambah rincian baru
                    $new = new NpdRincian();
                    $new->npd_detail_id = NpdDetail::where('npd_id', $npd->id)->where('kode_rekening', $details->kode_rekening)->first()->id;
                    $new->kode_rincian = $rinci->kode_rincian;
                    $new->anggaran = $rinci->anggaran;
                    $new->anggaran_perubahan = $rinci->anggaran_perubahan;
                    $new->jenis = $rinci->jenis;
                    $new->save();
                } else {
                    //update anggaran perubahan
                    $update = $checkRincian;
                    $update->anggaran_perubahan = $rinci->anggaran_perubahan;
                    $update->jenis = $rinci->jenis;
                    $update->save();
                }
            }
        }
        Session::flash('success', 'Berhasil');
        return back();
    }
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

        if ($data->jenis_anggaran === 'MURNI') {
            return view('superadmin.npdp.uraian', compact('data', 'detail'));
        } else {
            return view('superadmin.npdp.uraian_perubahan', compact('data', 'detail'));
        }
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
    public function jenisanggaran(Request $req)
    {
        $data = NPD::find($req->jenis_npd_id);
        $data->jenis_anggaran = $req->jenis_anggaran;
        $data->save();
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
                $item->anggaran = $item->rincian->sum('anggaran');
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
                    $item->anggaran = $item->rincian->sum('anggaran');
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
                    $item->anggaran = $item->rincian->sum('anggaran');
                    $item->sisa = $item->anggaran - $item->pencairan_saat_ini - $item->akumulasi;
                }
            }
            return $item;
        });


        $pdf  = Pdf::loadView('superadmin.npdp.pdf_npd', compact('data', 'detail'));
        $filename = $data->user->name . '-' . Carbon::now()->format('Y-m-d-H-i-s') . '.pdf';
        return $pdf->stream($filename);
    }

    public function deleteRekening($id)
    {
        NpdDetail::find($id)->delete();
        Session::flash('success', 'Berhasil di hapus');
        return back();
    }
}
