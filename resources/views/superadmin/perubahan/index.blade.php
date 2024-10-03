@extends('layouts.app')
@push('css')
    
@endpush
@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
          <div class="box box-success">
            <div class="box-header">
              <h3 class="box-title"><i class="fa fa-clipboard"></i> Data Perubahan Anggaran</h3>
    
              <div class="box-tools">
                {{-- <a href="/superadmin/npd/create" class="btn btn-sm btn-success "><i class="fa fa-plus-circle"></i> Tambah</a> --}}
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody>
                <tr>
                  <th class="text-center">No</th>
                  <th>Tahun Anggaran</th>
                  <th>Subkegiatan</th>
                  <th>Nilai Sebelum</th>
                  <th>Nilai Sesudah</th>
                  <th>Bertambah/Berkurang</th>
                  <th>Aksi</th>
                </tr>
                @foreach ($data as $key => $item)
                <tr>
                    <td class="text-center">{{$key + 1}}</td>
                    <td>{{$item->tahun_anggaran}}</td>
                    <td>{{$item->subkegiatan == null ? '': $item->subkegiatan->kode.' - '.$item->subkegiatan->nama}}</td>
                    <td class="text-right"><strong>{{number_format($item->dpa)}}</strong></td>
                    <td class="text-right"><strong>{{number_format($item->dpa_perubahan)}}</strong></td>
                    <td class="text-right"><strong>{{number_format($item->dpa_perubahan - $item->dpa)}}</strong></td>
                    
                    <td>
                        {{-- <a href="/superadmin/npd/uraian/{{$item->id}}" class="btn btn-sm  btn-success"><i class="fa fa-money"></i> URAIAN</a> --}}
                        <a href="/superadmin/perubahan/uraian/{{$item->id}}" class="btn btn-sm  btn-success"><i class="fa fa-edit"></i></a>
                        {{-- <a href="/superadmin/npd/delete/{{$item->id}}"
                            onclick="return confirm('Yakin ingin di hapus');"
                            class="btn btn-sm  btn-danger"><i class="fa fa-trash"></i></a> --}}
                     
                    </td>
                </tr>
                @endforeach
                
                </tbody>
                <tfoot>
                  <tr>
                    <td></td>
                    <td></td>
                    <td>TOTAL</td>
                    <td class="text-right"><strong>Rp. {{number_format($data->sum('dpa'))}}</strong></td>
                    <td class="text-right"><strong>Rp. {{number_format($data->sum('dpa_perubahan'))}}</strong></td>
                    <td class="text-right"><strong>Rp. {{number_format($data->sum('dpa_perubahan') - $data->sum('dpa'))}}</strong></td>
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

