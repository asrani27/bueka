@extends('layouts.app')
@push('css')
    
@endpush
@section('content')
<section class="content">
   <div class="row">
    <div class="col-md-12">
        <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-clipboard"></i> Tambah Data</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="/superadmin/npd/create" method="post">
                @csrf
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nomor NPD</label>
                  <div class="col-sm-10">
                    <input type="text" name="nomor" class="form-control" readonly placeholder="otomatis terisi">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Program</label>
                  <div class="col-sm-10">
                    <input type="text" name="program" class="form-control" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Kegiatan</label>
                  <div class="col-sm-10">
                    <input type="text" name="kegiatan" class="form-control" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Subkegiatan</label>
                  <div class="col-sm-10">
                    <input type="text" name="subkegiatan" class="form-control" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nomor DPA-/DPAL-/DPA-SKPD</label>
                  <div class="col-sm-10">
                    <input type="text" name="nomor_dpa" class="form-control" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Tahun Anggaran</label>
                  <div class="col-sm-10">
                    <input type="text" name="tahun_anggaran" class="form-control" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nama PPTK</label>
                  <div class="col-sm-10">
                    <input type="text" name="nama_pptk" class="form-control" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">NIP PPTK</label>
                  <div class="col-sm-10">
                    <input type="text" name="nip_pptk" class="form-control" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nama Pengguna Anggaran</label>
                  <div class="col-sm-10">
                    <input type="text" name="nama_pengguna_anggaran" class="form-control" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">NIP Pengguna Anggaran</label>
                  <div class="col-sm-10">
                    <input type="text" name="nip_pengguna_anggaran" class="form-control" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label"></label>
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-success btn-block"><i class="fa fa-save"></i> Simpan</button>
                    <a href="/superadmin/npd" class="btn bg-gray btn-block"><i class="fa fa-arrow-left"></i> Kembali</a>
                  </div>
                </div>
              </div>
            </form>
          </div>
    </div>
   </div>
    
</section>


@endsection
@push('js')

@endpush

