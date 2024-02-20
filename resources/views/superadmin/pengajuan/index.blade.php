@extends('layouts.app')
@push('css')
    
@endpush
@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
          <div class="box box-success">
            <div class="box-header">
              <h3 class="box-title"><i class="fa fa-clipboard"></i> Data Pengajuan Bibit</h3>
    
              <div class="box-tools">
                {{-- <a href="/pemohon/pengajuan/create" class="btn btn-sm btn-success "><i class="fa fa-plus-circle"></i> Tambah</a> --}}
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody>
                <tr>
                  <th class="text-center">No</th>
                  <th>Tanggal Pengajuan</th>
                  <th>Nama Kelompok Tani</th>
                  <th>Nama Akun</th>
                  <th>ALamat</th>
                  <th>Email</th>
                  <th>Bibit Yang Diajukan</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
                @foreach ($pengajuan as $key => $item)
                <tr>
                    <td class="text-center">{{$pengajuan->firstItem() + $key}}</td>
                    <td>{{\Carbon\Carbon::parse($item->tanggal)->format('d-m-Y')}}</td>
                    <td>{{$item->nama_kelompok}}</td>
                    <td>{{$item->nama}}</td>
                    <td>{{$item->alamat}}</td>
                    <td>{{$item->email}}</td>
                    <td>
                      
                      @foreach ($item->detail as $item2)
                          <li>{{$item2->bibit->nama}}, jumlah : {{$item2->jumlah}}</li>
                      @endforeach
                      @if ($item->status == null)
                      <a href="#" class="btn btn-xs btn-success tambah-bibit" data-id="{{$item->id}}"><i class="fa fa-plus-circle"></i></a>
                      @endif
                    </td>
                    <td>
                      @if ($item->status == 1)
                          <span class="label label-primary">Menunggu Validasi</span>
                      @endif

                      @if ($item->status == 2)
                          <span class="label label-success">di setujui</span>
                      @endif
                    </td>
                    
                    <td>
                      <a href="/superadmin/pengajuan/delete/{{$item->id}}"
                        onclick="return confirm('Yakin ingin di hapus');"
                        class="btn btn-xs btn-flat  btn-danger"><i class="fa fa-trash"></i></a>
                        <a href="#" class="btn btn-xs btn-flat  btn-danger validasi" data-id="{{$item->id}}"><i class="fa fa-edit"></i> Validasi</a>
                              
                    </td>
                </tr>
                @endforeach
                
              </tbody></table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          {{$pengajuan->links()}}
        </div>
    </div>
</section>

<!-- /.modal -->
<!-- /.modal -->
<div class="modal fade" id="modal-tambah">
  <div class="modal-dialog">
      <div class="modal-content">
          <form method="post" action="/superadmin/pengajuan/validasi" enctype="multipart/form-data">
              @csrf
              
              <div class="modal-header bg-success">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Validasi</h4>
              </div>

              <div class="modal-body">
                  <div class="form-group">
                  <div class="form-group">
                      <input type="hidden" class="form-control" id="pengajuan_id" name="pengajuan_id" readonly>
                  </div>
              </div>

              <div class="modal-footer">
                <div class="col-sm-6">

                  <button type="submit" class="btn btn-danger btn-block" name="button" value="tolak"><i class="fa fa-times"></i> Tolak Pengajuan</button>
                </div>
                <div class="col-sm-6">
                  
                  <button type="submit" class="btn btn-success btn-block" name="button"  value="setuju"><i class="fa fa-send"></i>Setujui Pengajuan</button>
                </div>
              </div>
          </form>
      </div>
  </div>
</div>
@endsection
@push('js')

<script>
  $(document).on('click', '.validasi', function() {
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
	</script>
  
@endpush

