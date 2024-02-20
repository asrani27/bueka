@extends('layouts.app')
@push('css')
    
@endpush
@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
          <div class="box box-success">
            <div class="box-header">
              <h3 class="box-title"><i class="fa fa-clipboard"></i> Data Serah Terima Bibit</h3>
    
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
                  <th>Bibit Yang Diserahkan</th>
                  <th>Validasi</th>
                  <th>Tanggal Diserahkan</th>
                  
                </tr>
                @foreach ($data as $key => $item)
                <tr>
                    <td class="text-center">{{$data->firstItem() + $key}}</td>
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
                      @if ($item->tgl_serah_terima == null)
                          
                        <a href="#" class="btn btn-xs btn-success serahterima" data-id="{{$item->id}}"><i class="fa fa-calendar"></i></a>
                      @else
                          
                        {{\Carbon\Carbon::parse($item->tgl_serah_terima)->format('d-m-Y')}} 
                        <a href="#" class="btn btn-xs btn-success serahterima" data-id="{{$item->id}}"><i class="fa fa-calendar"></i></a>
                      @endif
                    </td>
                    
                    
                </tr>
                @endforeach
                
              </tbody></table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          {{$data->links()}}
        </div>
    </div>
</section>

<!-- /.modal -->
<!-- /.modal -->
<div class="modal fade" id="modal-tambah">
  <div class="modal-dialog">
      <div class="modal-content">
          <form method="post" action="/superadmin/pengajuan/serahterima" enctype="multipart/form-data">
              @csrf
              
              <div class="modal-header bg-success">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tanggal Diserahkan</h4>
              </div>

              <div class="modal-body">
                  <div class="form-group">
                  <div class="form-group">
                    <input type="date" class="form-control" name="tgl_serah_terima" required>
                      <input type="hidden" class="form-control" id="pengajuan_id" name="pengajuan_id" readonly>
                  </div>
              </div>

              <div class="modal-footer">
                  <button type="submit" class="btn btn-success btn-block" name="button"  value="setuju"><i class="fa fa-send"></i>Kirim</button>
              </div>
          </form>
      </div>
  </div>
</div>
@endsection
@push('js')

<script>
  $(document).on('click', '.serahterima', function() {
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

