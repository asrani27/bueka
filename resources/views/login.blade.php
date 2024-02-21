<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>NPD</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="/assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="/assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="/assets/dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  
  <!-- IziToast -->
  <link rel="stylesheet" href="/notif/dist/css/iziToast.min.css">
  <script src="/notif/dist/js/iziToast.min.js" type="text/javascript"></script>
  <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-purple layout-top-nav">
<div class="wrapper">

  <header class="main-header">
    
  </header>
  <!-- Full Width Column -->
  <div class="content-wrapper"  style="background: rgb(60,141,188); background: linear-gradient(48deg, rgba(60,141,188,1) 0%, rgba(187,226,249,1) 100%);">
    <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        {{-- <h1>
          Top Navigation
          <small>Example 2.0</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="#">Layout</a></li>
          <li class="active">Top Navigation</li>
        </ol> --}}
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-md-4">
          </div>
          <div class="col-md-5">
            <div class="text-center">
            </div>
            
          <br/><br/>
            <div class="box" style="box-shadow: 0 8px 8px 0 rgba(0,0,0,.2);border-radius:10px">
              <div class="box-header  text-center">
                <br/>
                <img src="/logo/logo.png" width="100px" ><br/><br/>
                <h4> <strong>NOTA PENCAIRAN DANA (NPD)</strong></h4>
      
              </div>
              <form role="form" method="post" action="/login" autocomplete="off">
                @csrf
              <div class="box-body" style="padding:40px">
                <div class="form-group has-feedback">
                  <label>Username</label>
                  <input type="text" name="username" class="form-control" placeholder="user" required>
                  <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                  <label>Password</label>
                  <input type="password" name="password" class="form-control" placeholder="pass" required>
                  <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="cf-turnstile"
                    data-sitekey="{{ config('services.cloudflare.turnstile.site_key') }}"
                    data-callback="onTurnstileSuccess"
                ></div>
                <div class="form-group has-feedback">
                  <button type="submit" class="btn btn-primary btn-flat btn-block pull-right"><i class="fa fa-send"></i> MASUK</button>
                </div>
                <br/>
                <br/>
                <br/>
                <div>


                </div>
                <div class="text-center">
                  Aplikasi Bu Eka
                </div>
              </div>
              </form>
            </div>
          </div>
          <div class="col-md-4">
          </div>
        </div>
        
      </section>
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->
  
</div>
<!-- ./wrapper -->

<!-- jQuery 4 -->
<script src="/assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="/assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="/assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="/assets/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="/assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/assets/dist/js/demo.js"></script>

<script type="text/javascript">
  @include('layouts.notif')
  </script>
</body>
</html>
