      <!-- sidebar menu: : style can be found in sidebar.less -->

      <ul class="sidebar-menu" data-widget="tree"> 

        

        @include('menu.link_website')

<!-- ......................................................................... -->

        <li class="header">INVENTORY</li>



        <li class="{{ Request::is('inventory')?'active':null}}"><a href="{{URL('inventory')}}"><i class="fa fa-area-chart"></i> <span>Dashboard</span></a></li>

<!-- ......................................................................... -->  

        <li class="{{ Request::is('dealer')?'active':null}}"><a href="{{URL('dealer')}}"><i class="fa fa-home"></i> <span>Data Dealer</span></a></li>

<!-- ......................................................................... -->  

        <li class="{{ Request::is('manpower')?'active':null}}">
        <a href="{{URL('manpower/')}}"><i class="fa fa-group"></i> <span>Data Manpower</span>
        &nbsp;
        <span class="label label-danger">New!</span></a>
        </li>

<!-- ......................................................................... -->      

        <li class="treeview 

        {{ Request::is('stok/AA0101')?'active':null}}

        {{ Request::is('stok/AA0102')?'active':null}}

        {{ Request::is('stok/AA0104')?'active':null}}

        {{ Request::is('stok/AA0105')?'active':null}}

        {{ Request::is('stok/AA0106')?'active':null}}

        {{ Request::is('stok/AA0107')?'active':null}}

        {{ Request::is('stok/AA0108')?'active':null}}

        {{ Request::is('stok/AA0109')?'active':null}}

        {{ Request::is('stok/AA0104F')?'active':null}}">

          <a href="#">

            <i class="fa fa-motorcycle"></i> <span>Stok</span>

            <span class="pull-right-container">

              <i class="fa fa-angle-left pull-right"></i>

            </span>

          </a>

          <ul class="treeview-menu">

            <li class="{{ Request::is('stok/AA0101')?'active':null}}"><a href="{{URL('stok/AA0101')}}"><i class="fa fa-angle-double-right"></i> <span>Bisma Sentral</span></a></li>

            <li class="{{ Request::is('stok/AA0102')?'active':null}}"><a href="{{URL('stok/AA0102')}}"><i class="fa fa-angle-double-right"></i> <span>Bisma Cokro</span></a></li>

            <li class="{{ Request::is('stok/AA0104')?'active':null}}"><a href="{{URL('stok/AA0104')}}"><i class="fa fa-angle-double-right"></i> <span>Bisma Hasanuddin</span></a></li>

            <li class="{{ Request::is('stok/AA0105')?'active':null}}"><a href="{{URL('stok/AA0105')}}"><i class="fa fa-angle-double-right"></i> <span>Bisma TTS</span></a></li>

            <li class="{{ Request::is('stok/AA0106')?'active':null}}"><a href="{{URL('stok/AA0106')}}"><i class="fa fa-angle-double-right"></i> <span>Bisma Imbo</span></a></li>

            <li class="{{ Request::is('stok/AA0107')?'active':null}}"><a href="{{URL('stok/AA0107')}}"><i class="fa fa-angle-double-right"></i> <span>Bisma Mandiri</span></a></li>

            <li class="{{ Request::is('stok/AA0108')?'active':null}}"><a href="{{URL('stok/AA0108')}}"><i class="fa fa-angle-double-right"></i> <span>Bisma WR Supratman</span></a></li>

            <li class="{{ Request::is('stok/AA0109')?'active':null}}"><a href="{{URL('stok/AA0109')}}"><i class="fa fa-angle-double-right"></i> <span>Bisma Sunset Road</span></a></li>

            <li class="{{ Request::is('stok/AA0104F')?'active':null}}"><a href="{{URL('stok/AA0104F')}}"><i class="fa fa-angle-double-right"></i> <span>Flagship Shop Denpasar</span></a></li>

          </ul>

        </li>

<!-- ........................................................................... -->

        <li class="treeview

        {{ Request::is('in/masuk/'.$now.'/AA0101')?'active':null}}

        {{ Request::is('in/masuk/'.$now.'/AA0102')?'active':null}}

        {{ Request::is('in/masuk/'.$now.'/AA0104')?'active':null}}

        {{ Request::is('in/masuk/'.$now.'/AA0105')?'active':null}}

        {{ Request::is('in/masuk/'.$now.'/AA0106')?'active':null}}

        {{ Request::is('in/masuk/'.$now.'/AA0107')?'active':null}}

        {{ Request::is('in/masuk/'.$now.'/AA0108')?'active':null}}

        {{ Request::is('in/masuk/'.$now.'/AA0109')?'active':null}}

        {{ Request::is('in/masuk/'.$now.'/AA0104F')?'active':null}}">

          <a href="#">

            <i class="fa fa-sign-in"></i> <span>Stok Masuk</span>

            <span class="pull-right-container">

              <i class="fa fa-angle-left pull-right"></i>

            </span>

          </a>

          <ul class="treeview-menu">

            <li class="{{ Request::is('in/masuk/'.$now.'/AA0101')?'active':null}}"><a href="{{URL('in/masuk/'.$now.'/AA0101')}}"><i class="fa fa-angle-double-right"></i> <span>Bisma Sentral</span></a></li>

            <li class="{{ Request::is('in/masuk/'.$now.'/AA0102')?'active':null}}"><a href="{{URL('in/masuk/'.$now.'/AA0102')}}"><i class="fa fa-angle-double-right"></i> <span>Bisma Cokro</span></a></li>

            <li class="{{ Request::is('in/masuk/'.$now.'/AA0104')?'active':null}}"><a href="{{URL('in/masuk/'.$now.'/AA0104')}}"><i class="fa fa-angle-double-right"></i> <span>Bisma Hasanuddin</span></a></li>

            <li class="{{ Request::is('in/masuk/'.$now.'/AA0105')?'active':null}}"><a href="{{URL('in/masuk/'.$now.'/AA0105')}}"><i class="fa fa-angle-double-right"></i> <span>Bisma TTS</span></a></li>

            <li class="{{ Request::is('in/masuk/'.$now.'/AA0106')?'active':null}}"><a href="{{URL('in/masuk/'.$now.'/AA0106')}}"><i class="fa fa-angle-double-right"></i> <span>Bisma Imbo</span></a></li>

            <li class="{{ Request::is('in/masuk/'.$now.'/AA0107')?'active':null}}"><a href="{{URL('in/masuk/'.$now.'/AA0107')}}"><i class="fa fa-angle-double-right"></i> <span>Bisma Mandiri</span></a></li>

            <li class="{{ Request::is('in/masuk/'.$now.'/AA0108')?'active':null}}"><a href="{{URL('in/masuk/'.$now.'/AA0108')}}"><i class="fa fa-angle-double-right"></i> <span>Bisma WR Supratman</span></a></li>

            <li class="{{ Request::is('in/masuk/'.$now.'/AA0109')?'active':null}}"><a href="{{URL('in/masuk/'.$now.'/AA0109')}}"><i class="fa fa-angle-double-right"></i> <span>Bisma Sunset Road</span></a></li>

            <li class="{{ Request::is('in/masuk/'.$now.'/AA0104F')?'active':null}}"><a href="{{URL('in/masuk/'.$now.'/AA0104F')}}"><i class="fa fa-angle-double-right"></i> <span>Flagship Shop Denpasar</span></a></li>

          </ul>

        </li>

<!-- ......................................................................... -->      

        <li class="treeview

        {{ Request::is('out/keluar/'.$now.'/AA0101')?'active':null}}

        {{ Request::is('out/keluar/'.$now.'/AA0102')?'active':null}}

        {{ Request::is('out/keluar/'.$now.'/AA0104')?'active':null}}

        {{ Request::is('out/keluar/'.$now.'/AA0105')?'active':null}}

        {{ Request::is('out/keluar/'.$now.'/AA0106')?'active':null}}

        {{ Request::is('out/keluar/'.$now.'/AA0107')?'active':null}}

        {{ Request::is('out/keluar/'.$now.'/AA0108')?'active':null}}

        {{ Request::is('out/keluar/'.$now.'/AA0109')?'active':null}}

        {{ Request::is('out/keluar/'.$now.'/AA0104F')?'active':null}}">

          <a href="#">

            <i class="fa fa-sign-out"></i> <span>Stok Keluar</span>

            <span class="pull-right-container">

              <i class="fa fa-angle-left pull-right"></i>

            </span>

          </a>

          <ul class="treeview-menu">

            <li class="{{ Request::is('out/keluar/'.$now.'/AA0101')?'active':null}}"><a href="{{URL('out/keluar/'.$now.'/AA0101')}}"><i class="fa fa-angle-double-right"></i> <span>Bisma Sentral</span></a></li>

            <li class="{{ Request::is('out/keluar/'.$now.'/AA0102')?'active':null}}"><a href="{{URL('out/keluar/'.$now.'/AA0102')}}"><i class="fa fa-angle-double-right"></i> <span>Bisma Cokro</span></a></li>

            <li class="{{ Request::is('out/keluar/'.$now.'/AA0104')?'active':null}}"><a href="{{URL('out/keluar/'.$now.'/AA0104')}}"><i class="fa fa-angle-double-right"></i> <span>Bisma Hasanuddin</span></a></li>

            <li class="{{ Request::is('out/keluar/'.$now.'/AA0105')?'active':null}}"><a href="{{URL('out/keluar/'.$now.'/AA0105')}}"><i class="fa fa-angle-double-right"></i> <span>Bisma TTS</span></a></li>

            <li class="{{ Request::is('out/keluar/'.$now.'/AA0106')?'active':null}}"><a href="{{URL('out/keluar/'.$now.'/AA0106')}}"><i class="fa fa-angle-double-right"></i> <span>Bisma Imbo</span></a></li>

            <li class="{{ Request::is('out/keluar/'.$now.'/AA0107')?'active':null}}"><a href="{{URL('out/keluar/'.$now.'/AA0107')}}"><i class="fa fa-angle-double-right"></i> <span>Bisma Mandiri</span></a></li>

            <li class="{{ Request::is('out/keluar/'.$now.'/AA0108')?'active':null}}"><a href="{{URL('out/keluar/'.$now.'/AA0108')}}"><i class="fa fa-angle-double-right"></i> <span>Bisma WR Supratman</span></a></li>

            <li class="{{ Request::is('out/keluar/'.$now.'/AA0109')?'active':null}}"><a href="{{URL('out/keluar/'.$now.'/AA0109')}}"><i class="fa fa-angle-double-right"></i> <span>Bisma Sunset Road</span></a></li>

            <li class="{{ Request::is('out/keluar/'.$now.'/AA0104F')?'active':null}}"><a href="{{URL('out/keluar/'.$now.'/AA0104F')}}"><i class="fa fa-angle-double-right"></i> <span>Flagship Shop Denpasar</span></a></li>

          </ul>

        </li>

<!-- ......................................................................... -->      

        <li class="treeview

        {{ Request::is('sale/jual/'.$now.'/AA0101')?'active':null}}

        {{ Request::is('sale/jual/'.$now.'/AA0102')?'active':null}}

        {{ Request::is('sale/jual/'.$now.'/AA0104')?'active':null}}

        {{ Request::is('sale/jual/'.$now.'/AA0105')?'active':null}}

        {{ Request::is('sale/jual/'.$now.'/AA0106')?'active':null}}

        {{ Request::is('sale/jual/'.$now.'/AA0107')?'active':null}}

        {{ Request::is('sale/jual/'.$now.'/AA0108')?'active':null}}

        {{ Request::is('sale/jual/'.$now.'/AA0109')?'active':null}}

        {{ Request::is('sale/jual/'.$now.'/AA0104F')?'active':null}}">

          <a href="#">

            <i class="fa fa-check"></i> <span>Stok Terjual</span>

            <span class="pull-right-container">

              <i class="fa fa-angle-left pull-right"></i>

            </span>

          </a>

          <ul class="treeview-menu">

            <li class="{{ Request::is('sale/jual/'.$now.'/AA0101')?'active':null}}"><a href="{{URL('sale/jual/'.$now.'/AA0101')}}"><i class="fa fa-angle-double-right"></i> <span>Bisma Sentral</span></a></li>

            <li class="{{ Request::is('sale/jual/'.$now.'/AA0102')?'active':null}}"><a href="{{URL('sale/jual/'.$now.'/AA0102')}}"><i class="fa fa-angle-double-right"></i> <span>Bisma Cokro</span></a></li>

            <li class="{{ Request::is('sale/jual/'.$now.'/AA0104')?'active':null}}"><a href="{{URL('sale/jual/'.$now.'/AA0104')}}"><i class="fa fa-angle-double-right"></i> <span>Bisma Hasanuddin</span></a></li>

            <li class="{{ Request::is('sale/jual/'.$now.'/AA0105')?'active':null}}"><a href="{{URL('sale/jual/'.$now.'/AA0105')}}"><i class="fa fa-angle-double-right"></i> <span>Bisma TTS</span></a></li>

            <li class="{{ Request::is('sale/jual/'.$now.'/AA0106')?'active':null}}"><a href="{{URL('sale/jual/'.$now.'/AA0106')}}"><i class="fa fa-angle-double-right"></i> <span>Bisma Imbo</span></a></li>

            <li class="{{ Request::is('sale/jual/'.$now.'/AA0107')?'active':null}}"><a href="{{URL('sale/jual/'.$now.'/AA0107')}}"><i class="fa fa-angle-double-right"></i> <span>Bisma Mandiri</span></a></li>

            <li class="{{ Request::is('sale/jual/'.$now.'/AA0108')?'active':null}}"><a href="{{URL('sale/jual/'.$now.'/AA0108')}}"><i class="fa fa-angle-double-right"></i> <span>Bisma WR Supratman</span></a></li>

            <li class="{{ Request::is('sale/jual/'.$now.'/AA0109')?'active':null}}"><a href="{{URL('sale/jual/'.$now.'/AA0109')}}"><i class="fa fa-angle-double-right"></i> <span>Bisma Sunset Road</span></a></li>

            <li class="{{ Request::is('sale/jual/'.$now.'/AA0104F')?'active':null}}"><a href="{{URL('sale/jual/'.$now.'/AA0104F')}}"><i class="fa fa-angle-double-right"></i> <span>Flagship Shop Denpasar</span></a></li>

          </ul>

        </li>

<!-- ......................................................................... -->

        <li class="{{ Request::is('fands')?'active':null}}"><a href="{{URL('fands')}}"><i class="fa fa-pencil"></i> <span>Faktur & Service</span></a></li>



<!-- ......................................................................... -->      

        <li class="treeview

        {{ Request::is('opname/stok/'.$now.'/AA0101')?'active':null}}

        {{ Request::is('opname/stok/'.$now.'/AA0102')?'active':null}}

        {{ Request::is('opname/stok/'.$now.'/AA0104')?'active':null}}

        {{ Request::is('opname/stok/'.$now.'/AA0105')?'active':null}}

        {{ Request::is('opname/stok/'.$now.'/AA0106')?'active':null}}

        {{ Request::is('opname/stok/'.$now.'/AA0107')?'active':null}}

        {{ Request::is('opname/stok/'.$now.'/AA0108')?'active':null}}

        {{ Request::is('opname/stok/'.$now.'/AA0109')?'active':null}}

        {{ Request::is('opname/stok/'.$now.'/AA0104F')?'active':null}}">

          <a href="#">

            <i class="fa fa-briefcase"></i> <span>Stok Opname</span>

            <span class="pull-right-container">

              <i class="fa fa-angle-left pull-right"></i>

            </span>

          </a>

          <ul class="treeview-menu">

            <li class="{{ Request::is('opname/stok/'.$now.'/AA0101')?'active':null}}"><a href="{{URL('opname/stok/'.$now.'/AA0101')}}"><i class="fa fa-angle-double-right"></i> <span>Bisma Sentral</span></a></li>

            <li class="{{ Request::is('opname/stok/'.$now.'/AA0102')?'active':null}}"><a href="{{URL('opname/stok/'.$now.'/AA0102')}}"><i class="fa fa-angle-double-right"></i> <span>Bisma Cokro</span></a></li>

            <li class="{{ Request::is('opname/stok/'.$now.'/AA0104')?'active':null}}"><a href="{{URL('opname/stok/'.$now.'/AA0104')}}"><i class="fa fa-angle-double-right"></i> <span>Bisma Hasanuddin</span></a></li>

            <li class="{{ Request::is('opname/stok/'.$now.'/AA0105')?'active':null}}"><a href="{{URL('opname/stok/'.$now.'/AA0105')}}"><i class="fa fa-angle-double-right"></i> <span>Bisma TTS</span></a></li>

            <li class="{{ Request::is('opname/stok/'.$now.'/AA0106')?'active':null}}"><a href="{{URL('opname/stok/'.$now.'/AA0106')}}"><i class="fa fa-angle-double-right"></i> <span>Bisma Imbo</span></a></li>

            <li class="{{ Request::is('opname/stok/'.$now.'/AA0107')?'active':null}}"><a href="{{URL('opname/stok/'.$now.'/AA0107')}}"><i class="fa fa-angle-double-right"></i> <span>Bisma Mandiri</span></a></li>

            <li class="{{ Request::is('opname/stok/'.$now.'/AA0108')?'active':null}}"><a href="{{URL('opname/stok/'.$now.'/AA0108')}}"><i class="fa fa-angle-double-right"></i> <span>Bisma WR Supratman</span></a></li>

            <li class="{{ Request::is('opname/stok/'.$now.'/AA0109')?'active':null}}"><a href="{{URL('opname/stok/'.$now.'/AA0109')}}"><i class="fa fa-angle-double-right"></i> <span>Bisma Sunset Road</span></a></li>

            <li class="{{ Request::is('opname/stok/'.$now.'/AA0104F')?'active':null}}"><a href="{{URL('opname/stok/'.$now.'/AA0104F')}}"><i class="fa fa-angle-double-right"></i> <span>Flagship Shop Denpasar</span></a></li>

          </ul>

        </li>



        <li class="header">DAFTAR</li>

<!-- ......................................................................... -->

        <li class="{{ Request::is('unit')?'active':null}}"><a href="{{URL('unit')}}"><i class="fa fa-asterisk"></i> <span>Daftar Unit & Warna</span></a></li>

<!-- ......................................................................... -->

        <li class="{{ Request::is('leasing')?'active':null}}"><a href="{{URL('leasing')}}"><i class="fa fa-file"></i> <span>Daftar Leasing</span></a></li>

<!-- ......................................................................... -->

        <li class="header">LAPORAN</li>      



        <li class="treeview

        {{ Request::is('report')?'active':null}}

        {{ Request::is('report/unit')?'active':null}}

        {{ Request::is('report/riil')?'active':null}}">

          <a href="#">

            <i class="fa fa-file-text"></i> <span>Laporan</span>

            <span class="pull-right-container">

              <i class="fa fa-angle-left pull-right"></i>

            </span>

          </a>

          <ul class="treeview-menu">

            <li class="{{ Request::is('report')?'active':null}}"><a href="{{URL('report')}}"><i class="fa fa-angle-double-right"></i> <span>Laporan Stok</span></a></li>

            <li class="{{ Request::is('report/riil')?'active':null}}"><a href="{{URL('report/riil')}}"><i class="fa fa-angle-double-right"></i> <span>Laporan Penjualan Riil</span></a></li>

            <li class="{{ Request::is('report/unit')?'active':null}}"><a href="{{URL('report/unit')}}"><i class="fa fa-angle-double-right"></i> <span>Stok Unit</span></a></li>

          </ul>

        </li>

        <li class="{{ Request::is('lapor')?'active':null}}">
        <a href="{{URL('lapor')}}"><i class="fa fa-pencil"></i> <span>Buat Laporan Stok</span>
        &nbsp;
        <span class="label label-warning">Penting!</span></a>
        </li>



        <li class="header">BOOKING</li>

<!-- ......................................................................... -->

        @include('menu.link_booking_service')



        <li class="header">ADMIN</li>

<!-- ......................................................................... -->

        <li class="{{ Request::is('admin')?'active':null}}"><a href="{{URL('admin')}}"><i class="fa fa-user"></i> <span>Data Admin</span></a></li>

      </ul>