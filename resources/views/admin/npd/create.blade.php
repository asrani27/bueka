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
            <form class="form-horizontal" action="/admin/npd/create" method="post">
                @csrf
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Subkegiatan</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="npd_id">

                      @foreach ($subkegiatan as $item)
                        <option value="{{$item->id}}">({{$item->tahun_anggaran}}) {{$item->subkegiatan->kode}} -  {{$item->subkegiatan->nama}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Jenis Anggaran</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="jenis_anggaran" required>

                      <option value="">-</option>
                      <option value="MURNI">MURNI</option>
                      <option value="PERUBAHAN">PERUBAHAN</option>
                    </select>
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label"></label>
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-success btn-block"><i class="fa fa-save"></i> Simpan</button>
                    <a href="/admin/npd" class="btn bg-gray btn-block"><i class="fa fa-arrow-left"></i> Kembali</a>
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

