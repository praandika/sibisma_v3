<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login | SIBISMA</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  
  <!-- Favicons -->
  <link href="{{ asset('dist/img/SibismaIcon.png') }}" rel="icon">
  <link href="{{ asset('dist/img/SibismaIcon.png') }}" rel="apple-touch-icon">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('bower_components/Ionicons/css/ionicons.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('plugins/iCheck/square/blue.css') }}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style>
    .round{
      border-radius: 50px 0 0 50px;
    }
    .btn-custom{
      background: linear-gradient(90deg, rgba(220,0,247,1) 0%, rgba(12,41,144,1) 50%, rgba(12,41,144,1) 100%);
      border-color: unset;
      transition: padding 0.3s ease;

    }
    .btn-custom:hover{
      border-color: unset;
      background: linear-gradient(90deg, rgba(12,41,144,1) 0%, rgba(12,41,144,1) 50%, rgba(220,0,247,1) 100%);
      padding: 10px;
    }
    .btn-custom:focus{
      border-color: unset;
      background: linear-gradient(90deg, rgba(12,41,144,1) 0%, rgba(12,41,144,1) 50%, rgba(220,0,247,1) 100%);
      padding: 10px;
    }
    .input-custom{
      transition: padding 0.3s ease;
    }
    .input-custom:hover{
      border-color: rgba(220,0,247,1);
      padding-left: 50px;
    }
    .input-custom:focus{
      padding-left: 50px;
    }
  </style>
</head>
<body class="hold-transition login-page" style="background-color: #FFFFFF;">

<div class="login-box">
  <div class="login-logo">
    <img src="{{ asset('dist/img/logo-sibisma-warna.png') }}" alt="" width="300">
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Welcome to SIBISMA!</p>
      <form action="{{URL('/login')}}" method="POST">
      {{csrf_field()}}
      <div class="form-group has-feedback">
        <input type="text" name="user" class="form-control round input-custom" placeholder="Username" required="required">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback round">
        <input type="password" name="pass" class="form-control round input-custom" placeholder="Password" required="required">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block round btn-custom">Log In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
  <center>
      <br/>
      <p><strong>&copy; Tim CRM Bisma</strong></p>
  </center>
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- iCheck -->
<script src="{{ asset('plugins/iCheck/icheck.min.js') }}"></script>

@include('sweetalert::alert')

</body>
</html>
