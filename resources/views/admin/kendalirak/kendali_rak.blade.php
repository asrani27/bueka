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

<!-- Select2 -->
<link rel="stylesheet" href="/assets/bower_components/select2/dist/css/select2.min.css">
@endpush
@section('content')

<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-clipboard"></i>RENCANA ANGGARAN KAS </h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <div class="box-body table-responsive">
          <table width="100%">

            <tr>
              <td style="text-align:center;font-weight:bold" colspan="4">
                BENDAHARA PENGELUARAN<br />
                SKPD : ({{$data->subkegiatan == null ? '': $data->subkegiatan->kode}}) BAGIAN ORGANISASI SEKRETARIAT
                DAERAH KOTA BANJARMASIN
              </td>
            </tr>


            <tr>
              <td width="10px;">1</td>
              <td width="250px;">Urusan</td>
              <td width="10px;">:</td>
              <td>4-UNSUR PENDUKUNG URUSAN PEMERINTAHAN</td>
            </tr>
            <tr>
              <td width="10px;">2</td>
              <td width="250px;">Bidang Urusan</td>
              <td width="10px;">:</td>
              <td>4.01-SEKRETARIAT DAERAH</td>
            </tr>
            <tr>
              <td width="10px;">3</td>
              <td width="250px;">SKPD</td>
              <td width="10px;">:</td>
              <td>4.01.0.00.0.00.01.0000-Sekretariat Daerah Kota Banjarmasin</td>
            </tr>
            <tr>
              <td width="10px;">4</td>
              <td width="250px;">UNIT SKPD</td>
              <td width="10px;">:</td>
              <td>4.01.0.00.0.00.01.0003-Bagian Organisasi</td>
            </tr>

            <tr>
              <td>5</td>
              <td>Program</td>
              <td>:</td>
              <td>{{$data->program == null ? '': $data->program->kode .' - '.$data->program->nama}}</td>
            </tr>
            <tr>
              <td>6</td>
              <td>Kegiatan</td>
              <td>:</td>
              <td>{{$data->kegiatan == null ? '': $data->kegiatan->kode .' - '.$data->kegiatan->nama}}</td>
            </tr>
            <tr>
              <td>7</td>
              <td>Subkegiatan</td>
              <td>:</td>
              <td>{{$data->subkegiatan == null ? '': $data->subkegiatan->kode .' - '.$data->subkegiatan->nama}}</td>
            </tr>
            <tr>
              <td>8</td>
              <td>Tahun Anggaran</td>
              <td>:</td>
              <td>{{$data->tahun_anggaran}}</td>
            </tr>
            <tr>
              <td>9</td>
              <td>Nilai Anggaran </td>
              <td>:</td>
              <td></td>
            </tr>
          </table>
          <br />
          <table width="100%">
            <tr class="text-center text-bold" style="background-color: rgb(247, 171, 208);">
              <td rowspan="3">Kode Rekening</td>
              <td rowspan="3" style="min-width:250px;">Uraian</td>
              <td rowspan="3">Anggaran Tahun Ini</td>
              <td rowspan="3">Total RAK</td>
              <td colspan="6">Semester I</td>
              <td colspan="6">Semester II</td>
            </tr>
            <tr class="text-center text-bold" style="background-color: rgb(247, 171, 208);">
              <td colspan="3">Triwulan I</td>
              <td colspan="3">Triwulan II</td>
              <td colspan="3">Triwulan III</td>
              <td colspan="3">Triwulan IV</td>
            </tr>
            <tr class="text-center text-bold" style="background-color: rgb(247, 171, 208);">
              <td>Januari</td>
              <td>Februari</td>
              <td>Maret</td>
              <td>April</td>
              <td>Mei</td>
              <td>Juni</td>
              <td>Juli</td>
              <td>Agustus</td>
              <td>September</td>
              <td>Oktober</td>
              <td>November</td>
              <td>Desember</td>
            </tr>

            @foreach ($data->detail as $key => $item)
            <tr class="text-bold" style="font-size:12px">
              <td style="text-align: center">{{$item->kode_rekening}}
              </td>
              <td>{{$item->rekening->nama}}</td>
              <td style="text-align: right">{{number_format($item->total_rincian)}}</td>
              <td style="text-align: right">{{number_format($item->total_rak)}}</td>
              <td style="text-align: right">{{number_format($item->total_januari)}}</td>
              <td style="text-align: right">{{number_format($item->total_februari)}}</td>
              <td style="text-align: right">{{number_format($item->total_maret)}}</td>
              <td style="text-align: right">{{number_format($item->total_april)}}</td>
              <td style="text-align: right">{{number_format($item->total_mei)}}</td>
              <td style="text-align: right">{{number_format($item->total_juni)}}</td>
              <td style="text-align: right">{{number_format($item->total_juli)}}</td>
              <td style="text-align: right">{{number_format($item->total_agustus)}}</td>
              <td style="text-align: right">{{number_format($item->total_september)}}</td>
              <td style="text-align: right">{{number_format($item->total_oktober)}}</td>
              <td style="text-align: right">{{number_format($item->total_november)}}</td>
              <td style="text-align: right">{{number_format($item->total_desember)}}</td>
            </tr>
            @foreach ($item->rincian as $item2)
            <tr style="font-size:12px">
              <td style="text-align: right">

              </td>
              <td>{{$item2->rincian->nama}}</td>
              <td style="text-align: right">{{number_format($item2->anggaran)}}</td>
              <td style="text-align: right">{{number_format($item2->total_rak)}}</td>
              <td style="text-align: right">{{number_format($item2->januari)}} </td>
              <td style="text-align: right">{{number_format($item2->februari)}}</td>
              <td style="text-align: right">{{number_format($item2->maret)}}</td>
              <td style="text-align: right">{{number_format($item2->april)}}</td>
              <td style="text-align: right">{{number_format($item2->mei)}}</td>
              <td style="text-align: right">{{number_format($item2->juni)}}</td>
              <td style="text-align: right">{{number_format($item2->juli)}}</td>
              <td style="text-align: right">{{number_format($item2->agustus)}}</td>
              <td style="text-align: right">{{number_format($item2->september)}}</td>
              <td style="text-align: right">{{number_format($item2->oktober)}}</td>
              <td style="text-align: right">{{number_format($item2->november)}}</td>
              <td style="text-align: right">{{number_format($item2->desember)}}</td>
            </tr>
            <tr style="font-size: 12px;">
              <td colspan="4"></td>

              <td style="text-align: right; background-color:rgb(225, 247, 232)">
                {{number_format(realisasiBulanan($item2->kode_rincian,1,$data->tahun_anggaran))}}</td
                style="text-align: right">
              <td style=" text-align: right; background-color:rgb(225, 247, 232)">
                {{number_format(realisasiBulanan($item2->kode_rincian,2,$data->tahun_anggaran))}}</td
                style="text-align: right">
              <td style=" text-align: right; background-color:rgb(225, 247, 232)">
                {{number_format(realisasiBulanan($item2->kode_rincian,3,$data->tahun_anggaran))}}</td
                style="text-align: right">
              <td style=" text-align: right; background-color:rgb(225, 247, 232)">
                {{number_format(realisasiBulanan($item2->kode_rincian,4,$data->tahun_anggaran))}}</td
                style="text-align: right">
              <td style=" text-align: right; background-color:rgb(225, 247, 232)">
                {{number_format(realisasiBulanan($item2->kode_rincian,5,$data->tahun_anggaran))}}</td
                style="text-align: right">
              <td style=" text-align: right; background-color:rgb(225, 247, 232)">
                {{number_format(realisasiBulanan($item2->kode_rincian,6,$data->tahun_anggaran))}}</td
                style="text-align: right">
              <td style=" text-align: right; background-color:rgb(225, 247, 232)">
                {{number_format(realisasiBulanan($item2->kode_rincian,7,$data->tahun_anggaran))}}</td
                style="text-align: right">
              <td style=" text-align: right; background-color:rgb(225, 247, 232)">
                {{number_format(realisasiBulanan($item2->kode_rincian,8,$data->tahun_anggaran))}}</td
                style="text-align: right">
              <td style=" text-align: right; background-color:rgb(225, 247, 232)">
                {{number_format(realisasiBulanan($item2->kode_rincian,9,$data->tahun_anggaran))}}</td
                style="text-align: right">
              <td style="text-align: right; background-color:rgb(225, 247, 232)">
                {{number_format(realisasiBulanan($item2->kode_rincian,10,$data->tahun_anggaran))}}</td
                style="text-align: right">
              <td style=" text-align: right; background-color:rgb(225, 247, 232)">
                {{number_format(realisasiBulanan($item2->kode_rincian,11,$data->tahun_anggaran))}}</td
                style="text-align: right">
              <td style=" text-align: right; background-color:rgb(225, 247, 232)">
                {{number_format(realisasiBulanan($item2->kode_rincian,12,$data->tahun_anggaran))}}</td
                style="text-align: right">
            </tr>
            @endforeach
            @endforeach
            <tr style="font-size:12px">
              <td colspan="2">JUMLAH ALOKASI KAS YANG TERSEDIA DARI BELANJA PER BULAN</td>
              <td style="text-align: right;font-weight:bold">{{number_format($data->alokasi_anggaran)}}</td>
              <td style="text-align: right;font-weight:bold">{{number_format($data->alokasi_rak)}}</td>
              <td style="text-align: right;font-weight:bold">{{number_format($data->jumlah_januari)}}</td>
              <td style="text-align: right;font-weight:bold">{{number_format($data->jumlah_februari)}}</td>
              <td style="text-align: right;font-weight:bold">{{number_format($data->jumlah_maret)}}</td>
              <td style="text-align: right;font-weight:bold">{{number_format($data->jumlah_april)}}</td>
              <td style="text-align: right;font-weight:bold">{{number_format($data->jumlah_mei)}}</td>
              <td style="text-align: right;font-weight:bold">{{number_format($data->jumlah_juni)}}</td>
              <td style="text-align: right;font-weight:bold">{{number_format($data->jumlah_juli)}}</td>
              <td style="text-align: right;font-weight:bold">{{number_format($data->jumlah_agustus)}}</td>
              <td style="text-align: right;font-weight:bold">{{number_format($data->jumlah_september)}}</td>
              <td style="text-align: right;font-weight:bold">{{number_format($data->jumlah_oktober)}}</td>
              <td style="text-align: right;font-weight:bold">{{number_format($data->jumlah_november)}}</td>
              <td style="text-align: right;font-weight:bold">{{number_format($data->jumlah_desember)}}</td>
            </tr>
            <tr style="font-size:12px">
              <td colspan="2">JUMLAH ALOKASI KAS YANG TERSEDIA DARI BELANJA PER TRIWULAN</td>
              <td style="text-align: right;font-weight:bold">{{number_format($data->alokasi_anggaran)}}</td>
              <td style="text-align: right;font-weight:bold">{{number_format($data->alokasi_rak)}}</td>
              <td colspan="3" style="text-align: center;font-weight:bold">{{number_format($data->triwulan_satu)}}</td>
              <td colspan="3" style="text-align: center;font-weight:bold">{{number_format($data->triwulan_dua)}}</td>
              <td colspan="3" style="text-align: center;font-weight:bold">{{number_format($data->triwulan_tiga)}}</td>
              <td colspan="3" style="text-align: center;font-weight:bold">{{number_format($data->triwulan_empat)}}</td>
            </tr>
            <tr style="font-size:12px">
              <td colspan="2">JUMLAH ALOKASI KAS YANG TERSEDIA DARI BELANJA PER SEMESTER</td>
              <td style="text-align: right;font-weight:bold">{{number_format($data->alokasi_anggaran)}}</td>
              <td style="text-align: right;font-weight:bold">{{number_format($data->alokasi_rak)}}</td>
              <td colspan="6" style="text-align: center;font-weight:bold">{{number_format($data->semester_satu)}}</td>
              <td colspan="6" style="text-align: center;font-weight:bold">{{number_format($data->semester_dua)}}</td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>

</section>


@endsection
@push('js')

<!-- Select2 -->
<script src="/assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
  });
  function hanyaAngka(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
     if (charCode > 31 && (charCode < 48 || charCode > 57))
  
      return false;
    return true;
  }
</script>

<script>
  window.addEventListener('load', function () {
      const scrollPosition = localStorage.getItem('scrollPosition');

      if (scrollPosition !== null) {
          window.scrollTo(0, parseInt(scrollPosition, 10));
          localStorage.removeItem('scrollPosition');
      }

      window.addEventListener('beforeunload', function () {
          localStorage.setItem('scrollPosition', window.scrollY);
      });
  });
</script>

@endpush