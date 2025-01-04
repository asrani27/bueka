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
  <div class="callout callout-danger">
    <h4>Informasi!</h4>

    <p>
      Jika kolom berwarna merah adalah uraian/subkegiatan pada saat perubahan, dan angkanya secara otomatis 0, untuk
      melakukan perubahan pada angkanya, silahkan ke menu Perubahan Anggaran</p>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-clipboard"></i> Uraian NPD.</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <div class="box-body">
          <table width="100%">
            <tr>
              <td style="text-align:center;" colspan="4"><b>NOTA PENCAIRAN DANA (NPD)</b><br />
                NOMOR :
              </td>
            </tr>
            <tr>
              <td style="text-align:center;font-weight:bold" colspan="4">
                BENDAHARA PENGELUARAN<br />
                SKPD : ({{$data->subkegiatan == null ? '': $data->subkegiatan->kode}}) BAGIAN ORGANISASI SEKRETARIAT
                DAERAH KOTA BANJARMASIN
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
              <td>{{$data->program == null ? '': $data->program->kode .' - '.$data->program->nama}}</td>
            </tr>
            <tr>
              <td>3</td>
              <td>Kegiatan</td>
              <td>:</td>
              <td>{{$data->kegiatan == null ? '': $data->kegiatan->kode .' - '.$data->kegiatan->nama}}</td>
            </tr>
            <tr>
              <td>4</td>
              <td>Subkegiatan</td>
              <td>:</td>
              <td>{{$data->subkegiatan == null ? '': $data->subkegiatan->kode .' - '.$data->subkegiatan->nama}}</td>
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

            <tr>
              <td colspan="4">
                <button type="button" class="btn btn-primary btn-sm tambahuraian"><i class="fa fa-plus"></i> Tambah
                  Rekening</button>
              </td>
            </tr>
          </table>
          <table width="100%">
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
            @if ($item->jenis == 1)
            <tr class="text-bold" style="background-color: rgb(250, 197, 197)">
              @else
            <tr class="text-bold" style="background-color: antiquewhite">
              @endif
              <td>

                <a href="/superadmin/npd/uraian/{{$data->id}}/rekening/{{$item->id}}"
                  onclick="return confirm('Yakin ingin menghapus rekening');"><i class="fa fa-trash text-danger"></i>
                </a>

                {{$key + 1}}
              </td>
              <td>{{$item->kode_rekening}}</td>
              <td>
                <a href="#" data-npd_detail_id="{{$item->id}}" class="addrincian"><i
                    class="fa fa-plus text-success"></i> </a>

                {{$item->rekening == null ? '' : $item->rekening->nama}}
              </td>
              <td>{{number_format($item->rincian->sum('anggaran'))}}</td>
              <td></td>
              <td>{{$item->pencairan}}</td>
              <td>{{number_format($item->anggaran - $item->pencairan)}}</td>
            </tr>
            @foreach ($item->rincian as $item2)
            @if ($item2->jenis == 1)
            <tr style="background-color: rgb(248, 222, 222)">
              @else
            <tr>
              @endif
              <td></td>
              <td>{{$item2->kode_rincian}}</td>
              <td>

                <a href="/superadmin/deleterincian/{{$item2->id}}"
                  onclick="return confirm('Yakin ingin menghapus rincian');"><i class="fa fa-trash text-danger"></i>
                </a>
                {{$item2->rincian == null ? '' : $item2->rincian->nama}}
              </td>
              <td>{{number_format($item2->anggaran)}}</td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            @endforeach
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

  <div class="modal fade" id="modal-tambah">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="post" action="/superadmin/npd/uraian/{{$data->id}}/add" enctype="multipart/form-data">
          @csrf

          <div class="modal-header bg-primary">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Uraian.</h4>
          </div>

          <div class="modal-body">
            <div class="form-group">
              <label>Kode Rek</label>
              <select class="form-control" name="kode_rekening" required>
                <option value="">-pilih-</option>
                @foreach ($rekening as $item)
                <option value="{{$item->kode}}">{{$item->kode}} - {{$item->nama}}</option>
                @endforeach
              </select>
            </div>
            {{-- <div class="form-group">
              <label>Anggaran</label>
              <input type="text" class="form-control" name="anggaran" required onkeypress="return hanyaAngka(event)" />
            </div> --}}
            <div class="form-group">
              <label>Jenis</label>
              <select class="form-control" name="jenis">
                <option value="">MURNI</option>
                <option value="1">PERUBAHAN</option>
              </select>
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
  <div class="modal fade" id="modal-rincian">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="post" action="/superadmin/addrincian" enctype="multipart/form-data">
          @csrf

          <div class="modal-header bg-primary">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Rincian.</h4>
          </div>

          <div class="modal-body">
            <div class="form-group">
              <label>Kode Rincian</label>
              <select class="form-control select2" name="kode_rincian" required style="width: 100%;">
                <option value="">-pilih-</option>
                @foreach ($rincian as $item)
                <option value="{{$item->kode}}">{{$item->kode}} - {{$item->nama}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label>Anggaran</label>
              <input type="text" class="form-control" name="anggaran" required onkeypress="return hanyaAngka(event)" />
              <input type="hidden" class="form-control" id="npd_detail_id" name="npd_detail_id" required
                onkeypress="return hanyaAngka(event)" />
            </div>
            <div class="form-group">
              <label>Jenis</label>
              <select class="form-control" name="jenis">
                <option value="">MURNI</option>
                <option value="1">PERUBAHAN</option>
              </select>
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
  $(document).on('click', '.tambahuraian', function() {
     $("#modal-tambah").modal();
  });
</script>
<script>
  $(document).on('click', '.addrincian', function() {
     $('#npd_detail_id').val($(this).data('npd_detail_id'));
     $("#modal-rincian").modal();
  });
</script>
@endpush