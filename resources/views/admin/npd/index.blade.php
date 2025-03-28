@extends('layouts.app')
@push('css')

@endpush
@section('content')
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-success">
        <div class="box-header">
          <h3 class="box-title"><i class="fa fa-clipboard"></i> Data NPD</h3>

          <div class="box-tools">
            <a href="/admin/npd/create" class="btn btn-sm btn-success "><i class="fa fa-plus-circle"></i> Tambah</a>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tbody>
              <tr>
                <th class="text-center">No</th>
                <th>Admin</th>
                <th>Tanggal</th>
                <th>Nomor NPD</th>
                <th>Nomor DPA</th>
                <th>Jumlah Dana</th>
                <th>Tahun Anggaran</th>
                <th>Jenis Anggaran</th>
                <th>Sub Kegiatan</th>
                <th>Aksi</th>
              </tr>
              @foreach ($data as $key => $item)
              <tr>
                <td class="text-center">{{$data->firstItem() + $key}}</td>
                <td>{{$item->user->name}}</td>
                <td>{{\Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y')}}</td>
                <td>{{$item->nomor}}</td>
                <td>{{$item->nomor_dpa}}</td>
                <td>{{number_format($item->jumlah_dana)}}</td>
                <td>{{$item->tahun_anggaran}}</td>
                <td>{{$item->jenis_anggaran}}</td>
                <td>{{$item->subkegiatan->nama}}</td>

                <td>
                  <a href="/admin/npd/uraian/{{$item->id}}" class="btn btn-sm  btn-success"><i class="fa fa-money"></i>
                    URAIAN</a>

                  @if ($item->status == 0)

                  <a href="/admin/npd/delete/{{$item->id}}" onclick="return confirm('Yakin ingin di hapus');"
                    class="btn btn-sm  btn-danger"><i class="fa fa-trash"></i></a>
                  <a href="/admin/npd/ajukan/{{$item->id}}"
                    onclick="return confirm('Ketika sudah di ajukan, tidak bisa di hapus/edit, yakin?');"
                    class="btn btn-sm  btn-danger"><i class="fa fa-send"></i> KIRIM</a>
                  @else

                  @if (Auth::user()->id == $item->user_id)
                  <a href="/admin/npd/pdf/{{$item->id}}" class="btn btn-sm  btn-danger" target="_blank"><i
                      class="fa fa-file"></i> PDF</a>
                  @endif

                  @endif

                </td>
              </tr>
              @endforeach

            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      {{$data->links()}}
      <!-- /.box -->
    </div>
  </div>
</section>

<!-- /.modal -->
{{-- <div class="modal fade" id="modal-tambah">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="post" action="/pemohon/pengajuan/bibit" enctype="multipart/form-data">
        @csrf

        <div class="modal-header bg-success">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Pilih Bibit</h4>
        </div>

        <div class="modal-body">
          <div class="form-group">
            <label>Bibit</label>
            <select class="form-control" name="bibit_id">
              @foreach ($bibit as $item)
              <option value="{{$item->id}}">{{$item->nama}}, Stok : {{$item->stok}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label>Jumlah</label>
            <input type="text" class="form-control" name="jumlah" required onkeypress="return hanyaAngka(event)" />
          </div>
          <div class="form-group">
            <label>Pengajuan ID</label>
            <input type="text" class="form-control" id="pengajuan_id" name="pengajuan_id" readonly>
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
</div> --}}
@endsection
@push('js')

{{-- <script>
  $(document).on('click', '.tambah-bibit', function() {
    $('#pengajuan_id').val($(this).data('id'));
     $("#modal-tambah").modal();
  });
</script>
<script>
  function hanyaAngka(evt) {
		  var charCode = (evt.which) ? evt.which : event.keyCode
		   if (charCode > 31 && (charCode < 48 || charCode > 57))
 
		    return false;
		  return true;
		}
</script> --}}

@endpush