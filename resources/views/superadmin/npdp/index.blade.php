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
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody>
                <tr>
                  <th class="text-center">No</th>
                  <th>Admin</th>
                  <th>Nomor NPD</th>
                  <th>Tanggal</th>
                  <th>Nomor DPA</th>
                  <th>Tahun Anggaran</th>
                  <th>Jumlah Dana</th>
                  <th>Subkegiatan</th>
                  <th>Aksi</th>
                </tr>
                @foreach ($data as $key => $item)
                <tr>
                    <td class="text-center">{{$key + 1}}</td>
                    <td>{{$item->user == null ? '-': $item->user->name}}</td>
                    <td>
                      @if ($item->nomor == null)
                          
                      <a href="#" class="btn btn-sm btn-success isinomor" data-id="{{$item->id}}">isi nomor</a>
                      {{$item->nomor}}
                      @else
                      <a href="#" class="btn btn-sm btn-success isinomor" data-id="{{$item->id}}">{{$item->nomor}}</a>
                      @endif
                    </td>
                    <td>{{\carbon\Carbon::parse($item->created_at)->format('d M Y H:i:s')}}</td>
                    <td>{{$item->nomor_dpa}}</td>
                    <td>{{$item->tahun_anggaran}}</td>
                    <td>{{number_format($item->jumlah_dana)}}</td>
                    <td>{{$item->subkegiatan == null ? '': $item->subkegiatan->nama}}</td>
                    
                    <td>
                        <a href="/superadmin/pnpd/uraian/{{$item->id}}" class="btn btn-sm  btn-success"><i class="fa fa-money"></i> URAIAN</a>
                        @if ($item->validasi == 0)
                            
                        <a href="/superadmin/pnpd/delete/{{$item->id}}"
                          onclick="return confirm('Yakin ingin di hapus');"
                          class="btn btn-sm  btn-danger"><i class="fa fa-trash"></i></a>
                          <a href="/superadmin/pnpd/validasi/{{$item->id}}"
                            onclick="return confirm('Yakin ingin di validasi, setelah di validasi data tidak bisa diubah/dihapus');"
                            class="btn btn-sm  btn-primary"><i class="fa fa-check"></i> validasi</a>
                        @else
                        <a href="/superadmin/pnpd/pdf/{{$item->id}}" class="btn btn-sm  btn-danger"><i class="fa fa-file"></i> PDF</a>
                        @endif
                     
                    </td>
                </tr>
                @endforeach
                
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
    </div>
</section>

<!-- /.modal -->
<div class="modal fade" id="modal-tambah">
  <div class="modal-dialog">
      <div class="modal-content">
          <form method="post" action="/superadmin/pnpd/isinomor" enctype="multipart/form-data">
              @csrf
              
              <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Isi Nomor</h4>
              </div>

              <div class="modal-body">
                  <div class="form-group">
                  <div class="form-group">
                    <input type="text" class="form-control" id="nomor" name="nomor" required>
                      <input type="hidden" class="form-control" id="npd_id" name="npd_id" readonly>
                  </div>
              </div>

              <div class="modal-footer">
                <div class="col-sm-12">
                  <button type="submit" class="btn btn-success btn-block" name="button" value="tolak"><i class="fa fa-save"></i> Simpan</button>
                </div>
              </div>
          </form>
      </div>
  </div>
</div>
@endsection
@push('js')

<script>
  $(document).on('click', '.isinomor', function() {
    $('#npd_id').val($(this).data('id'));
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
	</script>
  
@endpush

