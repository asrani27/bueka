@extends('layouts.app')
@push('css')
    <style>

        table, th, td {
          border: 1px solid black;
          border-collapse: collapse;
        }
        th, td {
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
                <table width="100%" >
                  <tr>
                    <td style="text-align:center;" colspan="4"><b>NOTA PENCAIRAN DANA (NPD)</b><br/>
                    NOMOR : 
                    </td>
                  </tr>
                  <tr>
                    <td style="text-align:center;font-weight:bold" colspan="4">
                      BENDAHARA PENGELUARAN<br/>
                      SKPD : (4.01.03.03.)  BAGIAN ORGANISASI SEKRETARIAT DAERAH KOTA BANJARMASIN
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
                    <td>{{$data->program}}</td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td>Kegiatan</td>
                    <td>:</td>
                    <td>{{$data->kegiatan}}</td>
                  </tr>
                  <tr>
                    <td>4</td>
                    <td>Subkegiatan</td>
                    <td>:</td>
                    <td>{{$data->subkegiatan}}</td>
                  </tr>
                  <tr>
                    <td>5</td>
                    <td>Nomor DPA-/DPAL-/DPA-SKPD  </td>
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
                    <td></td>
                  </tr>
                  <tr>
                    <td>8</td>
                    <td>Terbilang</td>
                    <td>:</td>
                    <td></td>
                  </tr>
                  <tr>
                    <td colspan="4" style="text-align: center"><b>PEMBEBANAN PADA KODE REKENING :</b></td>
                  </tr>
                </table>
                <table width="100%" >
                  <tr>
                    <td>No Urut</td>
                    <td>Kode Rekening</td>
                    <td>Uraian</td>
                    <td>Anggaran</td>
                    <td>Akumulasi</td>
                    <td>Pencairan Saat Ini</td>
                    <td>Sisa</td>
                  </tr>
                  @foreach ($data->detail as $key => $item)
                      <tr>
                        <td>{{$key + 1}}</td>
                        <td>{{$item->kode_rekening}}</td>
                        <td>{{$item->uraian}}</td>
                        <td>{{number_format($item->anggaran)}}</td>
                        <td></td>
                        <td>{{$item->pencairan}}</td>
                        <td>{{number_format($item->anggaran - $item->pencairan)}}</td>
                      </tr>
                  @endforeach
                  <tr style="background-color: aquamarine">
                    <td colspan=3>TOTAL</td>
                    <td>{{number_format($data->detail->sum('anggaran'))}}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td colspan=6 style="text-align: center">PPN</td>
                    <td></td>
                  </tr>
                  <tr>
                    <td colspan=6 style="text-align: center">PPh 21</td>
                    <td></td>
                  </tr>
                  <tr>
                    <td colspan=6 style="text-align: center">PPh 22</td>
                    <td></td>
                  </tr>
                  <tr>
                    <td colspan=6 style="text-align: center">PPh 23</td>
                    <td></td>
                  </tr>
                  <tr>
                    <td colspan=6 style="text-align: center">PPh pasal 4 (2)</td>
                    <td></td>
                  </tr>
                  <tr>
                    <td colspan=7></td>
                  </tr>
                  <tr>
                    <td colspan=4 style="text-align: center">Jumlah Yang Diminta</td>
                    <td>Rp., </td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td colspan=4 style="text-align: center">Potongan</td>
                    <td>Rp., </td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td colspan=4 style="text-align: center">Jumlah Yang Dibayarkan</td>
                    <td>Rp., </td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td colspan=4 style="text-align: center">Terbilang</td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                </table>
                <table width="100%">
                  <tr style="text-align: center">
                    <td></td>
                    <td>Banjarmasin, {{\Carbon\Carbon::now()->translatedFormat('F Y')}}</td>
                  </tr>
                  <tr style="text-align: center">
                    <td>Menyetujui, <br/>Kuasa Pengguna Anggaran
                      <br/><br/><br/>
                      <b><u>{{$data->nama_pengguna_anggaran}}</u></b><br/>
                      <b>{{$data->nip_pengguna_anggaran}}</b>
                    
                    </td>
                    <td><br/>Pejabat Pelaksana Teknis Kegiatan,
                    <br/><br/><br/>
                    <b><u>{{$data->nama_pptk}}</u></b><br/>
                    <b>{{$data->nip_pptk}}</b>
                    </td>
                  </tr>
                </table>
              </div>
          </div>
    </div>
   </div>
    
   <div class="modal fade" id="modal-tambah">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="/superadmin/npd/uraian/{{$data->id}}/add" enctype="multipart/form-data">
                @csrf
                
                <div class="modal-header bg-primary">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Uraian</h4>
                </div>
  
                <div class="modal-body">
                    <div class="form-group">
                        <label>Kode Rek</label>
                        <input type="text" class="form-control" name="kode_rekening" required/>
                    </div>
                    <div class="form-group">
                        <label>Uraian</label>
                        <input type="text" class="form-control" name="uraian" required>
                    </div>
                    <div class="form-group">
                        <label>Anggaran</label>
                        <input type="text" class="form-control" name="anggaran" required>
                    </div>
                </div>
  
                <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-send"></i>
                        Kirim</button>
                </div>
            </form>
        </div>
    </div>
  </div> 
</section>


@endsection
@push('js')


<script>
  $(document).on('click', '.tambahuraian', function() {
     $("#modal-tambah").modal();
  });
  </script>
@endpush

