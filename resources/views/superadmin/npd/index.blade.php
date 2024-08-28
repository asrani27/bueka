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
                <a href="/superadmin/npd/create" class="btn btn-sm btn-success "><i class="fa fa-plus-circle"></i> Tambah</a>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody>
                <tr>
                  <th class="text-center">No</th>
                  <th>Tanggal</th>
                  <th>Nomor DPA</th>
                  <th>Tahun Anggaran</th>
                  <th>Nilai DPA</th>
                  <th>Subkegiatan</th>
                  <th>Aksi</th>
                </tr>
                @foreach ($data as $key => $item)
                <tr>
                    <td class="text-center">{{$key + 1}}</td>
                    <td>{{\carbon\Carbon::parse($item->created_at)->format('d M Y H:i:s')}}</td>
                    <td>{{$item->nomor_dpa}}</td>
                    <td>{{$item->tahun_anggaran}}</td>
                    <td class="text-right"><strong>{{number_format($item->dpa)}}</strong></td>
                    <td>{{$item->subkegiatan == null ? '': $item->subkegiatan->kode.' - '.$item->subkegiatan->nama}}</td>
                    
                    <td>
                        <a href="/superadmin/npd/uraian/{{$item->id}}" class="btn btn-sm  btn-success"><i class="fa fa-money"></i> URAIAN</a>
                        <a href="/superadmin/npd/edit/{{$item->id}}" class="btn btn-sm  btn-success"><i class="fa fa-edit"></i></a>
                        <a href="/superadmin/npd/delete/{{$item->id}}"
                            onclick="return confirm('Yakin ingin di hapus');"
                            class="btn btn-sm  btn-danger"><i class="fa fa-trash"></i></a>
                     
                    </td>
                </tr>
                @endforeach
                
                </tbody>
                <tfoot>
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>TOTAL</td>
                    <td class="text-right"><strong>{{number_format($data->sum('dpa'))}}</strong></td>
                    <td></td>
                    <td></td>
                  </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
    </div>
</section>

<!-- /.modal -->
 
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

