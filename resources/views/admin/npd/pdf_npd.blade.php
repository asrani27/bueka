<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF</title>
</head>
<body>
    <table width="100%" style="font-family:Verdana, Geneva, Tahoma, sans-serif;font-size:11px;border-collapse:collapse">
        <tr>
        <td  style="text-align: center;border:1px solid black;padding:3px" colspan="4"><b>NOTA PENCAIRAN DANA (NPD)</b><br/>
        NOMOR : {{$data->nomor}}
        </td>
        </tr>
        <tr>
        <td  style="text-align: center;border:1px solid black;padding:3px" colspan="4">
            BENDAHARA PENGELUARAN<br/>
            SKPD : (4.01.03.03.)  BAGIAN ORGANISASI SEKRETARIAT DAERAH KOTA BANJARMASIN
        </td>
        </tr>
        <tr>
        <td colspan="4" style="border-left:1px solid black; padding-left:3px;border-right:1px solid black;">Supaya mencairkan dana kepada :</td>
        </tr>
        <tr>
        <td width="10px;" style="border-left:1px solid black; padding-left:3px;">1.</td>
        <td width="250px;">Pejabat Pelaksana Teknis Kegiatan</td>
        <td width="10px;">:</td>
        <td style="border-right:1px solid black;">{{$data->nama_pptk}}</td>
        </tr>
        <tr>
        <td style="border-left:1px solid black; padding-left:3px;">2.</td>
        <td>Program</td>
        <td>:</td>
        <td style="border-right:1px solid black;">{{$data->program == null ? '': $data->program->kode. ' - ' .$data->program->nama}}</td>
        </tr>
        <tr>
        <td style="border-left:1px solid black; padding-left:3px;">3.</td>
        <td>Kegiatan</td>
        <td>:</td>
        <td style="border-right:1px solid black;">{{$data->kegiatan == null ? '': $data->kegiatan->kode. ' - ' .$data->kegiatan->nama}}</td>
        </tr>
        <tr>
        <td style="border-left:1px solid black; padding-left:3px;">4.</td>
        <td>Subkegiatan</td>
        <td>:</td>
        <td style="border-right:1px solid black;">{{$data->subkegiatan == null ? '': $data->subkegiatan->kode. ' - ' .$data->subkegiatan->nama}}</td>
        </tr>
        <tr>
        <td style="border-left:1px solid black; padding-left:3px;">5.</td>
        <td>Nomor DPA-/DPAL-/DPA-SKPD  </td>
        <td>:</td>
        <td style="border-right:1px solid black;">{{$data->nomor_dpa}}</td>
        </tr>
        <tr>
        <td style="border-left:1px solid black; padding-left:3px;">6.</td>
        <td>Tahun Anggaran</td>
        <td>:</td>
        <td style="border-right:1px solid black;">{{$data->tahun_anggaran}}</td>
        </tr>
        <tr>
        <td style="border-left:1px solid black; padding-left:3px;">7.</td>
        <td>Jumlah dana yang diminta </td>
        <td>:</td>
        <td style="border-right:1px solid black;">{{number_format($data->detail->sum('pencairan_saat_ini'))}}</td>
        </tr>
        <tr>
        <td style="border-left:1px solid black; padding-left:3px;">8.</td>
        <td>Terbilang</td>
        <td>:</td>
        <td style="border-right:1px solid black;">{{terbilang($data->detail->sum('pencairan_saat_ini'))}} Rupiah</td>
        </tr>
        <tr>
        <td colspan="4" style="border-left:1px solid black;border-right:1px solid black; padding-left:3px;text-align:center"><br/><b>PEMBEBANAN PADA KODE REKENING :</b></td>
        </tr>
    </table>
    <table width="100%" style="border-collapse:collapse;font-family:Verdana, Geneva, Tahoma, sans-serif;font-size:11px;border:1px solid black;">
        <tr style="border:1px solid black">
        <th style="border:1px solid black;text-align:center;padding:7px">No Urut</th>
        <th style="border:1px solid black;text-align:center;padding:7px">Kode Rekening</th>
        <th style="border:1px solid black;text-align:center;padding:7px">Uraian</th>
        <th style="border:1px solid black;text-align:center;padding:7px">Anggaran</th>
        <th style="border:1px solid black;text-align:center;padding:7px">Akumulasi</th>
        <th style="border:1px solid black;text-align:center;padding:7px">Pencairan Saat Ini</th>
        <th style="border:1px solid black;text-align:center;padding:7px">Sisa</th>
        </tr>
        @foreach ($detail as $key => $item)
            <tr class="text-bold">
            <td style="border:1px solid black;padding:3px">{{$key + 1}}</td>
            <td style="border:1px solid black;padding:3px">{{$item->rekening == null ? '' : $item->rekening->kode}}</td>
            <td style="border:1px solid black;padding:3px">{{$item->rekening == null ? '' : $item->rekening->nama}}</td>
            <td style="text-align: right;border:1px solid black;padding:3px">{{number_format($item->anggaran)}}</td>
            <td style="text-align: right;border:1px solid black;padding:3px">{{number_format($item->akumulasi)}}</td>
            <td style="text-align: right;border:1px solid black;padding:3px">{{number_format($item->pencairan_saat_ini)}}</td>
            <td style="text-align: right;border:1px solid black;padding:3px">{{number_format($item->sisa)}}</td>
            </tr>
        @endforeach
        <tr class="text-bold" style="font-weight: bold">
        <td colspan=3 style="text-align: right;border:1px solid black;padding:3px">TOTAL</td>
        <td style="text-align: right;border:1px solid black;padding:3px">{{number_format($data->detail->sum('anggaran'))}}</td>
        <td style="text-align: right;border:1px solid black;padding:3px">{{number_format($data->detail->sum('akumulasi'))}}</td>
        <td style="text-align: right;border:1px solid black;padding:3px">{{number_format($data->detail->sum('pencairan_saat_ini'))}}</td>
        <td style="text-align: right;border:1px solid black;padding:3px">{{number_format($data->detail->sum('sisa'))}}</td>
        </tr>
        <tr>
        <td colspan=6  style="text-align: right;border:1px solid black;padding:3px">PPN</td>
        <td  style="text-align: right;border:1px solid black;padding:3px">

            @if ($data->status == 0)
            <button type="button" class="btn btn-primary btn-xs ppn"><i class="fa fa-plus"></i></button>
            @endif
            {{number_format($data->ppn)}}
        </td>
        </tr>
        <tr>
        <td colspan=6  style="text-align: right;border:1px solid black;padding:3px">PPh 21</td>
        <td  style="text-align: right;border:1px solid black;padding:3px">
            @if ($data->status == 0)
            <button type="button" class="btn btn-primary btn-xs pph21"><i class="fa fa-plus"></i></button>
            @endif
            {{number_format($data->pph21)}}
        </td>
        </tr>
        <tr>
        <td colspan=6  style="text-align: right;border:1px solid black;padding:3px">PPh 22</td>
        <td  style="text-align: right;border:1px solid black;padding:3px">
            @if ($data->status == 0)
            <button type="button" class="btn btn-primary btn-xs pph22"><i class="fa fa-plus"></i></button>
            @endif
            {{number_format($data->pph22)}}
        </td>
        </tr>
        <tr>
        <td colspan=6  style="text-align: right;border:1px solid black;padding:3px">PPh 23</td>
        <td  style="text-align: right;border:1px solid black;padding:3px">
            @if ($data->status == 0)
            <button type="button" class="btn btn-primary btn-xs pph23"><i class="fa fa-plus"></i></button>
            @endif
            {{number_format($data->pph23)}}
        </td>
        </tr>
        <tr>
        <td colspan=6  style="text-align: right;border:1px solid black;padding:3px">PPh pasal 4 (2)</td>
        <td style="text-align: right;border:1px solid black;padding:3px">
            @if ($data->status == 0)
            <button type="button" class="btn btn-primary btn-xs pph4"><i class="fa fa-plus"></i></button>
            @endif
            {{number_format($data->pph4)}}
        </td style="text-align: right;border:1px solid black;padding:3px">
        </tr>
        <tr>
        <td colspan=7 style="text-align: right;border:1px solid black;padding:3px"></td>
        </tr>
        <tr>
        <td colspan=4  style="text-align: right;border:1px solid black;padding:3px">Jumlah Yang Diminta</td>
        <td  style="text-align: right;border:1px solid black;padding:3px">Rp., </td>
        <td  style="text-align: right;border:1px solid black;padding:3px">{{number_format($data->detail->sum('pencairan_saat_ini'))}}</td>
        <td style="text-align: right;border:1px solid black;padding:3px"></td>
        </tr>
        <tr>
        <td colspan=4  style="text-align: right;border:1px solid black;padding:3px">Potongan</td>
        <td style="text-align: right;border:1px solid black;padding:3px">Rp., </td>
        <td style="text-align: right">{{number_format($data->potongan)}}</td>
        <td style="text-align: right;border:1px solid black;padding:3px"></td>
        </tr>
        <tr>
        <td colspan=4  style="text-align: right;border:1px solid black;padding:3px">Jumlah Yang Dibayarkan</td>
        <td style="text-align: right;border:1px solid black;padding:3px">Rp., </td>
        <td style="text-align: right;border:1px solid black;padding:3px">{{number_format($data->detail->sum('pencairan_saat_ini')-$data->potongan)}}</td>
        <td style="text-align: right;border:1px solid black;padding:3px"></td>
        </tr>
        <tr>
        <td colspan=4  style="text-align: right;border:1px solid black;padding:3px">Terbilang</td>
        
        <td colspan=3  style="text-align: right;border:1px solid black;padding:3px">{{terbilang($data->detail->sum('pencairan_saat_ini') - $data->potongan)}} Rupiah</td>
        
        </tr>
    </table><br/>
    <table width="100%" style="font-family:Verdana, Geneva, Tahoma, sans-serif;font-size:11px">
        <tr style="text-align: center">
        <td></td>
        <td>Banjarmasin, {{\Carbon\Carbon::now()->translatedFormat('F Y')}}</td>
        </tr>
        <tr style="text-align: center">
        <td>Menyetujui, <br/>Kuasa Pengguna Anggaran
            <br/><br/><br/><br/><br/>
            <b><u>{{$data->nama_pengguna_anggaran}}</u></b><br/>
            <b>{{$data->nip_pengguna_anggaran}}</b>
        
        </td>
        <td><br/>Pejabat Pelaksana Teknis Kegiatan,
        <br/><br/><br/><br/><br/>
        <b><u>{{$data->nama_pptk}}</u></b><br/>
        <b>{{$data->nip_pptk}}</b>
        </td>
        </tr>
    </table>
</body>
</html>