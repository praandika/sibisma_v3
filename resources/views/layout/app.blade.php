<!DOCTYPE html>

<html>

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

  

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>SIBISMA | {{ $title }}</title>



  <!-- Favicons -->

  <link href="{{ asset('dist/img/SibismaIcon.png') }}" rel="icon">

  <link href="{{ asset('dist/img/SibismaIcon.png') }}" rel="apple-touch-icon">



  <!-- Tell the browser to be responsive to screen width -->

  <meta name="viewport" content="width=device-width, initial-scale=1">



  <!-- Bootstrap 3.3.7 -->

  <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">

  <!-- Font Awesome -->

  <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}">

  <!-- Ionicons -->

  <link rel="stylesheet" href="{{ asset('bower_components/Ionicons/css/ionicons.min.css') }}">

  <!-- Theme style -->

  <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css') }}">

  <!-- AdminLTE Skins. Choose a skin from the css/skins

       folder instead of downloading all of them to reduce the load. -->

  <link rel="stylesheet" href="{{ asset('dist/css/skins/_all-skins.min.css') }}">

  <!-- Morris chart -->

  <link rel="stylesheet" href="{{ asset('bower_components/morris.js/morris.css') }}">

  <!-- jvectormap -->

  <link rel="stylesheet" href="{{ asset('bower_components/jvectormap/jquery-jvectormap.css') }}">

  <!-- Date Picker -->

  <link rel="stylesheet" href="{{ asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">

  <!-- Daterange picker -->

  <link rel="stylesheet" href="{{ asset('bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">

  <!-- DataTables -->

  <link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">

  <!-- AdminLTE Skins. Choose a skin from the css/skins

       folder instead of downloading all of them to reduce the load. -->

  <link rel="stylesheet" href="{{ asset('dist/css/skins/_all-skins.min.css') }}">

  <!-- iCheck -->

  <link rel="stylesheet" href="{{ asset('plugins/iCheck/all.css') }}">

  <!-- Popper Modal -->

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

  <!-- bootstrap datepicker -->

  <link rel="stylesheet" href="{{ asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">

  <!-- Select2 -->

  <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />

  <!-- Select2 Bootstrap Theme -->

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.css">

  

  <!-- Tanya.js -->

  <script src="{{ asset('tanya.js') }}"></script>



  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->

  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

  <!--[if lt IE 9]>

  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>

  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

  <![endif]-->



  <!-- Google Font -->

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <style>
		.round-custom-1{
			border-radius: 0 50px 50px 0;
    }
    
    .round-custom-2{
			border-radius: 50px 0 0 50px;
    }
    
    .btn-custom{
      border-color: #2c8ebf;
      color: #2c8ebf;
      transition: all 0.7s ease;
      border-radius: 0px;
    }
    .btn-custom:hover{
      border-color: #c90808;
      border-radius: 50px 50px 50px 50px;
      padding-left: 25px;
      padding-right: 25px;
      font-weight: bold;
    }
    .btn-custom:focus{
      border-color: #c90808;
      border-radius: 50px 50px 50px 50px;
      padding-left: 25px;
      padding-right: 25px;
      font-weight: bold;
    }
	</style>

  @yield('css')



</head>

<body class="hold-transition skin-blue sidebar-mini">

<div class="wrapper">



  <header class="main-header">

    <!-- Logo -->

    <a href="{{ URL('inventory') }}" class="logo">

      <!-- mini logo for sidebar mini 50x50 pixels -->

      <span class="logo-mini"><b>SI</b></span>

      <!-- logo for regular state and mobile devices -->

      <span class="logo-lg"><b>SI</b>BISMA</span>

    </a>

    <!-- Header Navbar: style can be found in header.less -->

    <nav class="navbar navbar-static-top">

      <!-- Sidebar toggle button-->

      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">

        <span class="sr-only">Toggle navigation</span>

      </a>



      <div class="navbar-custom-menu">

        <ul class="nav navbar-nav">

        @if(Session::get('akses') == "super")
        <!-- Notifications: style can be found in dropdown.less -->
        <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-clock-o"></i>
              <span class="label label-warning">{{ $count_user }}</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">
                <strong>Login History</strong> <br>
                {{ $count_user }} user(s) are loged in
              </li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">

                @foreach($data_user as $o)
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <i class="fa fa-user text-aqua"></i> {{ $o->username }}
                      </div>
                      <div class="pull-right">
                        <span style="text-align: right;">{{ $o->login }}</span>
                      </div>
                    </a>
                  </li>
                @endforeach
                </ul>
              </li>
              <li class="footer"><a href="" data-toggle="modal" data-target="#historyLogin">View Detail</a></li>
            </ul>
          </li>
          <!-- Tasks: style can be found in dropdown.less -->
        @endif
          

          <!-- User Account: style can be found in dropdown.less -->

          <li class="dropdown user user-menu">

            <a href="#" class="dropdown-toggle" data-toggle="dropdown">

              <img src="{{ asset('dist/img/SibismaIconMerah.png') }}" class="user-image" alt="User Image">

              <span class="hidden-xs">{{ Session::get('name') }}</span>

            </a>

            <ul class="dropdown-menu">

              <!-- User image -->

              <li class="user-header">

                <img src="{{ asset('dist/img/SibismaIconMerah.png') }}" class="img-circle" alt="User Image">



                <p>

                  <small>

                  Sistem Informasi & Inventory Bisma<br>

                  &copy; Tim CRM Bisma Group <br>

                  Est 2019 <br>

                </small>

                </p>

              </li>

              

              <!-- Menu Footer-->

              <li class="user-footer">

                <center>

                  <div>

                    <a href="{{ URL('logout') }}" class="btn btn-default round btn-custom">Log out</a>

                  </div>

                </center>

              </li>

            </ul>

          </li>

        </ul>

      </div>

    </nav>

  </header>



  <!-- Left side column. contains the logo and sidebar -->

  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->

    <section class="sidebar">

      <!-- Sidebar user panel -->

      <div class="user-panel">

        <div class="pull-left image">

          <img src="{{ asset('dist/img/SibismaIconMerah.png') }}" class="img-circle" alt="User Image">

        </div>

        <div class="pull-left info">

          <p>{{ Session::get('user') }}</p>

          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>

        </div>

      </div>

      

      <!-- MENU -->

      @if(Session::get('akses') == "super")

        @include('menu.menu_super')

      @elseif((Session::get('akses') == "admin") AND (Session::get('dealer') == "AA0101"))

        @include('menu.menu_sentral')

      @elseif((Session::get('akses') == "admin") AND (Session::get('dealer') == "AA0102"))

        @include('menu.menu_bmm')

      @elseif((Session::get('akses') == "admin") AND (Session::get('dealer') == "AA0104"))

        @include('menu.menu_ud')

      @elseif((Session::get('akses') == "admin") AND (Session::get('dealer') == "AA0105"))

        @include('menu.menu_tts')

      @elseif((Session::get('akses') == "admin") AND (Session::get('dealer') == "AA0106"))

        @include('menu.menu_imbo')

      @elseif((Session::get('akses') == "admin") AND (Session::get('dealer') == "AA0107"))

        @include('menu.menu_mandiri')

      @elseif((Session::get('akses') == "admin") AND (Session::get('dealer') == "AA0108"))

        @include('menu.menu_wr')

      @elseif((Session::get('akses') == "admin") AND (Session::get('dealer') == "AA0109"))

        @include('menu.menu_sunset')

      @elseif((Session::get('akses') == "admin") AND (Session::get('dealer') == "AA0104F"))

        @include('menu.menu_fss')

      @elseif((Session::get('akses') == "owner") AND (Session::get('dealer') == "khusus1"))

        @include('menu.menu_khusus1')

      @elseif((Session::get('akses') == "owner") AND (Session::get('dealer') == "khusus2"))

        @include('menu.menu_khusus2')

      @elseif((Session::get('akses') == "owner") AND (Session::get('dealer') == "khusus3"))

        @include('menu.menu_khusus3')
<!-- ----------------------VIEWER------------------------------------------------------------------- -->

      @elseif((Session::get('akses') == "viewer") AND (Session::get('dealer') == "all"))

        @include('menu.menu_view')

      @elseif((Session::get('akses') == "viewer") AND (Session::get('dealer') == "all"))

        @include('menu.menu_view')

      @elseif((Session::get('akses') == "viewer") AND (Session::get('dealer') == "all"))

        @include('menu.menu_view')

      @elseif((Session::get('akses') == "viewer") AND (Session::get('dealer') == "all"))

        @include('menu.menu_view')

      @elseif((Session::get('akses') == "viewer") AND (Session::get('dealer') == "all"))

        @include('menu.menu_view')

      @elseif((Session::get('akses') == "viewer") AND (Session::get('dealer') == "all"))

        @include('menu.menu_view')

      @elseif((Session::get('akses') == "viewer") AND (Session::get('dealer') == "all"))

        @include('menu.menu_view')

      @elseif((Session::get('akses') == "viewer") AND (Session::get('dealer') == "all"))

        @include('menu.menu_view')

      @elseif((Session::get('akses') == "viewer") AND (Session::get('dealer') == "all"))

        @include('menu.menu_view')                                                                

      @else

        @include('menu.menu_view')

      @endif

      <!-- END MENU -->



    </section>

    <!-- /.sidebar -->

  </aside>

<!-- ......................................................................... -->



  <!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <section class="content-header">

      <h1>

        {{$title}}

        <small>Sistem Informasi Bisma Group</small>

      </h1>

      <ol class="breadcrumb">

        <li><a href="{{URL('inventory')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>

        <li class="active">{{$title}}</li>

      </ol>

    </section>



    <!-- Main content -->

    <section class="content">



    @yield('content')  

    @if(Session('login') == TRUE)
      @include('modal.login_history')
    @endif

    </section>

    <!-- /.content -->

  </div>

  <!-- /.content-wrapper -->

<!-- ================================================================================== -->



  <footer class="main-footer">

    <div class="pull-right hidden-xs">

    <p>Akses: {{ Session::get('akses') }}</p>

    </div>

    <strong>&copy; Tim CRM Bisma | SIBISMA v2.0.1</strong>

  </footer>



</div>

<!-- ./wrapper -->







<!-- jQuery 3 -->

<script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>



<!-- DataTables -->

<script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>

<script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>



<!-- Bootstrap 3.3.7 -->

<script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>

<!-- jQuery UI 1.11.4 -->

<script src="{{ asset('bower_components/jquery-ui/jquery-ui.min.js') }}"></script>

<!-- Select2 -->

<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>

<!-- Select2 Bootstrap Theme -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css"></script>

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

<script>

  $.widget.bridge('uibutton', $.ui.button);

</script>

<script>

  $.fn.select2.defaults.set( "theme", "bootstrap" );

</script>

<script>

  $(document).ready(function() {

    $('.js-example-basic-single').select2({

      placeholder: "Pilih Warna",

      allowClear: true

    });

  });

</script>

<!-- Morris.js charts -->

<script src="{{ asset('bower_components/raphael/raphael.min.js') }}"></script>

<script src="{{ asset('bower_components/morris.js/morris.min.js') }}"></script>

<!-- Sparkline -->

<script src="{{ asset('bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>

<!-- jQuery Knob Chart -->

<script src="{{ asset('bower_components/jquery-knob/dist/jquery.knob.min.js') }}"></script>

<!-- daterangepicker -->

<script src="{{ asset('bower_components/moment/min/moment.min.js') }}"></script>

<script src="{{ asset('bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

<!-- datepicker -->

<script src="{{ asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>

<!-- Slimscroll -->

<script src="{{ asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>

<!-- FastClick -->

<script src="{{ asset('bower_components/fastclick/lib/fastclick.js') }}"></script>

<!-- AdminLTE App -->

<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->

<script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>

<!-- AdminLTE for demo purposes -->

<script src="{{ asset('dist/js/demo.js') }}"></script>

<!-- iCheck -->

<script src="{{ asset('plugins/iCheck/iCheck.min.js') }}"></script>

<!-- bootstrap datepicker -->

<script src="{{ asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>

<!-- Chart -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>

<!-- AJAX -->

<!-- Clipboard -->

<script src="{{ asset('dist/clipboard.min.js') }}"></script>







<!-- page script -->

@include('sweetalert::alert')

@yield('script')



</body>

</html>

