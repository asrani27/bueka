@extends('layouts.app')
@push('css')
<style>
  table,
  th,
  td {
    border: 1px solid black;
    border-collapse: collapse;
  }

  th,
  td {
    padding: 5px;
  }
</style>
@endpush
@section('content')
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-clipboard"></i> Uraian NPD</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <div class="box-body">
          <table width="100%">
            <tr>
              <td style="text-align:center;" colspan="4"><b>NOTA PENCAIRAN DANA (NPD)</b><br />
                NOMOR : {{$data->nomor}}
              </td>
            </tr>
            <tr>
              <td style="text-align:center;font-weight:bold" colspan="4">
                BENDAHARA PENGELUARAN<br />
                SKPD : (4.01.03.03.) BAGIAN ORGANISASI SEKRETARIAT DAERAH KOTA BANJARMASIN
              </td>
            </tr>
            <tr>
              <td colspan="4">Supaya mencairkan dana kepada :</td>
            </tr>
            <tr>
              <td width="10px;">1</td>
              <td width="250px;">Pejabat Pelaksana Teknis Kegiatan</td>
              <td width="10px;">:</td>
              <td>{{$data->nama_pptk}}</td>
            </tr>
            <tr>
              <td>2</td>
              <td>Program</td>
              <td>:</td>
              <td>{{$data->program == null ? '': $data->program->kode. ' - ' .$data->program->nama}}</td>
            </tr>
            <tr>
              <td>3</td>
              <td>Kegiatan</td>
              <td>:</td>
              <td>{{$data->kegiatan == null ? '': $data->kegiatan->kode. ' - ' .$data->kegiatan->nama}}</td>
            </tr>
            <tr>
              <td>4</td>
              <td>Subkegiatan</td>
              <td>:</td>
              <td>{{$data->subkegiatan == null ? '': $data->subkegiatan->kode. ' - ' .$data->subkegiatan->nama}}</td>
            </tr>
            <tr>
              <td>5</td>
              <td>Nomor DPA-/DPAL-/DPA-SKPD </td>
              <td>:</td>
              <td>{{$data->nomor_dpa}}</td>
            </tr>
            <tr>
              <td>6</td>
              <td>Tahun Anggaran</td>
              <td>:</td>
              <td>{{$data->tahun_anggaran}}</td>
            </tr>
            <tr>
              <td>7</td>
              <td>Jumlah dana yang diminta </td>
              <td>:</td>
              <td>{{number_format($data->detail->sum('pencairan_saat_ini'))}}</td>
            </tr>
            <tr>
              <td>8</td>
              <td>Terbilang</td>
              <td>:</td>
              <td>{{terbilang($data->detail->sum('pencairan_saat_ini'))}} Rupiah</td>
            </tr>
            <tr>
              <td>9</td>
              <td>Jenis Anggaran</td>
              <td>:</td>
              <td>{{$data->jenis_anggaran}}</td>
            </tr>
            <tr>
              <td colspan="4" style="text-align: center"><b>PEMBEBANAN PADA KODE REKENING :</b></td>
            </tr>
          </table>
          <table width="100%">
            <tr>
              <td>No Urut</td>
              <td>Kode Rekening</td>
              <td>Uraian</td>
              <td>Anggaran

              </td>
              <td>Akumulasi</td>
              <td>Pencairan Saat Ini</td>
              <td>Sisa</td>
            </tr>
            @foreach ($detail as $key => $item)

            @if ($item->jenis == 1)
            <tr class="text-bold" style="background-color: rgb(250, 197, 197)">
              @else
            <tr class="text-bold" style="background-color: antiquewhite">
              @endif
              <td>{{$key + 1}}</td>
              <td>{{$item->rekening == null ? '' : $item->rekening->kode}}</td>
              <td>{{$item->rekening == null ? '' : $item->rekening->nama}}</td>
              <td class="text-right">{{number_format($item->total_rincian)}}</td>
              <td class="text-right">{{number_format($item->total_akumulasi_rincian)}}</td>
              <td style="text-align: right">{{number_format($item->pencairan_saat_ini)}}

              </td>
              <td class="text-right">{{number_format($item->total_rincian - $item->total_akumulasi_rincian
                -$item->pencairan_saat_ini)}}</td>
            </tr>

            @foreach ($item->rincian as $key2 => $item2)
            @if ($item2->jenis == 1)
            <tr style="background-color: rgb(248, 222, 222)">
              @else
            <tr>
              @endif
              <td></td>
              <td>{{$item2->kode_rincian}}</td>
              <td>{{$item2->rincian->nama}}</td>
              <td class="text-right">{{number_format($item2->anggaran)}}</td>
              <td class="text-right">{{number_format($item2->akumulasi_rincian)}}</td>
              <td class="text-right">

                {{number_format($item2->pencairan)}}
              </td>
              <td class="text-right">
                {{number_format($item2->anggaran - $item2->pencairan - $item2->akumulasi_rincian)}}
              </td>
            </tr>
            @endforeach
            @endforeach
            <tr style="background-color: aquamarine" class="text-bold">
              <td colspan=3>TOTAL</td>
              <td class="text-right">{{number_format($data->total_dpa)}}</td>
              <td style="text-align: right">{{number_format($data->total_akumulasi)}}</td>
              <td style="text-align: right">{{number_format($data->total_pencairan)}}</td>
              <td class="text-right">{{number_format($data->total_dpa - $data->total_akumulasi -
                $data->total_pencairan)}}</td>
            </tr>
            <tr>
              <td colspan=6 style="text-align: center">PPN</td>
              <td class="text-right">
                {{number_format($data->ppn)}}
              </td>
            </tr>
            <tr>
              <td colspan=6 style="text-align: center">PPh 21</td>
              <td class="text-right">
                {{number_format($data->pph21)}}
              </td>
            </tr>
            <tr>
              <td colspan=6 style="text-align: center">PPh 22</td>
              <td class="text-right">
                {{number_format($data->pph22)}}
              </td>
            </tr>
            <tr>
              <td colspan=6 style="text-align: center">PPh 23</td>
              <td class="text-right">
                {{number_format($data->pph23)}}
              </td>
            </tr>
            <tr>
              <td colspan=6 style="text-align: center">PPh pasal 4 (2)</td>
              <td class="text-right">
                {{number_format($data->pph4)}}
              </td>
            </tr>
            <tr>
              <td colspan=7></td>
            </tr>
            <tr>
              <td colspan=4 style="text-align: center">Jumlah Yang Diminta</td>
              <td class="text-right">Rp., </td>
              <td class="text-right">{{number_format($data->detail->sum('pencairan_saat_ini'))}}</td>
              <td></td>
            </tr>
            <tr>
              <td colspan=4 style="text-align: center">Potongan</td>
              <td class="text-right">Rp., </td>
              <td class="text-right">{{number_format($data->potongan)}}</td>
              <td></td>
            </tr>
            <tr>
              <td colspan=4 style="text-align: center">Jumlah Yang Dibayarkan</td>
              <td class="text-right">Rp., </td>
              <td class="text-right">{{number_format($data->detail->sum('pencairan_saat_ini') - $data->potongan)}}</td>
              <td></td>
            </tr>
            <tr>
              <td colspan=4 style="text-align: center">Terbilang</td>
              <td></td>
              <td class="text-right">{{terbilang($data->detail->sum('pencairan_saat_ini') - $data->potongan)}} Rupiah
              </td>
              <td></td>
            </tr>
          </table>
          <table width="100%">
            <tr style="text-align: center">
              <td></td>
              <td>Banjarmasin, {{\Carbon\Carbon::parse($data->tanggal)->translatedFormat('d F Y')}}</td>
            </tr>
            <tr style="text-align: center">
              <td>Menyetujui, <br />Kuasa Pengguna Anggaran
                <br /><br /><br />
                <b><u>{{$data->nama_pengguna_anggaran}}</u></b><br />
                <b>{{$data->nip_pengguna_anggaran}}</b>

              </td>
              <td><br />Pejabat Pelaksana Teknis Kegiatan,
                <br /><br /><br />
                <b><u>{{$data->nama_pptk}}</u></b><br />
                <b>{{$data->nip_pptk}}</b>
              </td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>


</section>


@endsection
@push('js')
<script>
  function hanyaAngka(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
     if (charCode > 31 && (charCode < 48 || charCode > 57))
  
      return false;
    return true;
  }
</script>

<script>
  $(document).on('click', '.tambahuraian', function() {
     $("#modal-tambah").modal();
  });

  $(document).on('click', '.pencairan', function() {
    $('#npd_rincian_id').val($(this).data('id'));
     $("#modal-pencairan").modal();
  });
</script>
@endpush