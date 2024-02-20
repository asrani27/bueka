@extends('layouts.app')
@push('css')
    
@endpush
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="box box-success">
          <div class="box-header">
            <i class="ion ion-clipboard"></i><h3 class="box-title">Data Laporan</h3>

            <div class="box-tools">
              
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive">
            <a href="/superadmin/laporan/user" target="_blank" class="btn btn-sm btn-success">LAP. USER</a>
            <a href="/superadmin/laporan/bibit" target="_blank" class="btn btn-sm btn-success">LAP. BIBIT</a>
            <a href="/superadmin/laporan/stok" target="_blank" class="btn btn-sm btn-success">LAP. STOK BIBIT</a>
            <a href="/superadmin/laporan/pengajuan" target="_blank" class="btn btn-sm btn-success">LAP. PENGAJUAN</a>
            <a href="/superadmin/laporan/validasi" target="_blank" class="btn btn-sm btn-success">LAP. VALIDASI</a>
            <a href="/superadmin/laporan/serahterima" target="_blank" class="btn btn-sm btn-success">LAP. SERAH TERIMA</a>
          </div>
          <!-- /.box-body -->
        </div>
        
        <!-- /.box -->
      </div>
</div>

<div class="row">
  <div class="col-md-12">
      <div class="box box-success">
        <div class="box-header">
          <i class="ion ion-clipboard"></i><h3 class="box-title">Data Laporan Per Periode</h3>

          <div class="box-tools">
            
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive">
          <form method="post" action="/superadmin/laporan/periode" target="_blank">
            @csrf
          Mulai
          <input type="date" name="mulai">
          Sampai
          <input type="date" name="sampai">
          Laporan
          <select name="jenis" required>
            <option value="">-pilih-</option>
            <option value="pengajuan">Pengajuan</option>
            <option value="validasi">Validasi</option>
            <option value="serahterima">Serah Terima</option>
          </select>
          &nbsp;
          &nbsp;
          &nbsp;
          <button type="submit" class="btn btn-xs btn-primary">Print</button>
        </form>
        </div>
        <!-- /.box-body -->
      </div>
      
      <!-- /.box -->
    </div>
</div>
@endsection
@push('js')

@endpush
