@extends('layouts.app')
@push('css')
    
@endpush
@section('content')
<section class="content">
   <div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-clipboard"></i> Edit Konfigurasi Frontend</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
            <form class="form-horizontal" action="/superadmin/beranda" method="post" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Judul</label>
                    <div class="col-sm-10">
                      <input type="text" name="judul" class="form-control" value="{{$data->judul}}" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Deskripsi</label>
                    <div class="col-sm-10">
                      <input type="text" name="deskripsi" class="form-control" value="{{$data->deskripsi}}" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Gambar 1</label>
                    <div class="col-sm-10">
                      <img src="/storage/image/{{$data->gambar1}}" width="100px">
                      <input type="file" name="gambar1" class="form-control">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Gambar 2</label>
                    <div class="col-sm-10">
                      <img src="/storage/image/{{$data->gambar2}}" width="100px">
                      <input type="file" name="gambar2" class="form-control">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Jumlah Dosen</label>
                    <div class="col-sm-10">
                      <input type="text" name="jml_dosen" class="form-control" value="{{$data->jml_dosen}}" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Jumlah Program Studi</label>
                    <div class="col-sm-10">
                      <input type="text" name="jml_programstudi" class="form-control" value="{{$data->jml_programstudi}}" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Jumlah Matkul</label>
                    <div class="col-sm-10">
                      <input type="text" name="jml_matkul" class="form-control" value="{{$data->jml_matkul}}" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Gambar 3</label>
                    <div class="col-sm-10">
                      <img src="/storage/image/{{$data->gambar3}}" width="100px">
                      <input type="file" name="gambar3" class="form-control">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Fitur 01</label>
                    <div class="col-sm-10">
                      <input type="text" name="fitur1" class="form-control" value="{{$data->fitur1}}" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Fitur 01 Deskripsi</label>
                    <div class="col-sm-10">
                      <input type="text" name="fitur1_deskripsi" class="form-control" value="{{$data->fitur1_deskripsi}}" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Fitur 02</label>
                    <div class="col-sm-10">
                      <input type="text" name="fitur2" class="form-control" value="{{$data->fitur2}}" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Fitur 02 Deskripsi</label>
                    <div class="col-sm-10">
                      <input type="text" name="fitur2_deskripsi" class="form-control" value="{{$data->fitur2_deskripsi}}" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Fitur 03</label>
                    <div class="col-sm-10">
                      <input type="text" name="fitur3" class="form-control" value="{{$data->fitur3}}" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Fitur 03 Deskripsi</label>
                    <div class="col-sm-10">
                      <input type="text" name="fitur3_deskripsi" class="form-control" value="{{$data->fitur3_deskripsi}}" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Link AppStore</label>
                    <div class="col-sm-10">
                      <input type="text" name="appstore" class="form-control" value="{{$data->appstore}}" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Link PlayStore</label>
                    <div class="col-sm-10">
                      <input type="text" name="playstore" class="form-control" value="{{$data->playstore}}" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">alamat</label>
                    <div class="col-sm-10">
                      <input type="text" name="alamat" class="form-control" value="{{$data->alamat}}" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                      <input type="text" name="email" class="form-control" value="{{$data->email}}" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Telp</label>
                    <div class="col-sm-10">
                      <input type="text" name="telp" class="form-control" value="{{$data->telp}}" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Partner 1</label>
                    <div class="col-sm-10">
                      <img src="/storage/image/{{$data->partner1}}" width="100px">
                      <input type="file" name="partner1" class="form-control">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Partner 2</label>
                    <div class="col-sm-10">
                      <img src="/storage/image/{{$data->partner2}}" width="100px">
                      <input type="file" name="partner2" class="form-control">
                    </div>
                  </div>
                
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                      <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-save"></i> Update</button>
                      <a href="/superadmin/mahasiswa" class="btn bg-gray btn-block"><i class="fa fa-arrow-left"></i> Kembali</a>
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

