@extends('layouts.app')
@push('css')
    
@endpush
@section('content')
<section class="content">
   <div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-clipboard"></i> Edit user</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
            <form class="form-horizontal" action="/superadmin/user/edit/{{$data->id}}" method="post">
                @csrf
                <div class="box-body">
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Nama Lengkap</label>
                    <div class="col-sm-10">
                      <input type="text" name="name" class="form-control" value="{{$data->name}}" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Username</label>
                    <div class="col-sm-10">
                      <input type="text" name="username" class="form-control" value="{{$data->username}}" readonly>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-10">
                      <input type="text" name="password" class="form-control" value="">
                      <small>Note : kosongkan password jika tidak di ganti</small>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Role / Hak Akses</label>
                    <div class="col-sm-10">
                          <select name="role_id" class="form-control" required>
                              <option value="">-pilih-</option>
                              @foreach ($role as $item)
                              <option value="{{$item->id}}"{{$data->roles->first()->id == $item->id ? 'selected':''}}>{{$item->name}}</option>
                              @endforeach
                          </select>
                    </div>
                  </div>
                
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                      <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-save"></i> Update</button>
                      <a href="/superadmin/user" class="btn bg-gray btn-block"><i class="fa fa-arrow-left"></i> Kembali</a>
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

