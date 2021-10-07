      <!-- sidebar menu: : style can be found in sidebar.less -->

      <ul class="sidebar-menu" data-widget="tree"> 

        @include('menu.link_website')

<!-- ......................................................................... -->
        <li class="header">INVENTORY</li>

        <li class="{{ Request::is('inventory')?'active':null}}"><a href="{{URL('inventory')}}"><i class="fa fa-area-chart"></i> <span>Dashboard</span></a></li>

<!-- ......................................................................... -->  

        <li class="{{ Request::is('dealer')?'active':null}}"><a href="{{URL('dealer')}}"><i class="fa fa-home"></i> <span>Data Dealer</span></a></li>

<!-- ......................................................................... -->      

        <li class="{{ Request::is('stok/AA0101')?'active':null}}"><a href="{{URL('stok/AA0101')}}"><i class="fa fa-angle-double-right"></i> <span>Stok</span></a></li>

<!-- ......................................................................... -->     

        <li class="{{ Request::is('in/masuk/'.$now.'/AA0101')?'active':null}}"><a href="{{URL('in/masuk/'.$now.'/AA0101')}}"><i class="fa fa-angle-double-right"></i> <span>Stok Masuk</span></a></li>

<!-- ......................................................................... -->      

        <li class="{{ Request::is('out/keluar/'.$now.'/AA0101')?'active':null}}"><a href="{{URL('out/keluar/'.$now.'/AA0101')}}"><i class="fa fa-angle-double-right"></i> <span>Stok Keluar</span></a></li>

<!-- ......................................................................... -->      

        <li class="{{ Request::is('sale/jual/'.$now.'/AA0101')?'active':null}}"><a href="{{URL('sale/jual/'.$now.'/AA0101')}}"><i class="fa fa-angle-double-right"></i> <span>Stok Terjual</span></a></li>

<!-- ......................................................................... -->

        <li class="{{ Request::is('fands/AA0101')?'active':null}}"><a href="{{URL('fands/AA0101')}}"><i class="fa fa-pencil"></i> <span>Faktur & Service</span></a></li>

<!-- ......................................................................... -->

        <li class="{{ Request::is('opname/stok/'.$now.'/AA0101')?'active':null}}"><a href="{{URL('opname/stok/'.$now.'/AA0101')}}"><i class="fa fa-briefcase"></i> <span>Stok Opname</span></a></li>

<!-- ......................................................................... -->        

        <li class="header">DAFTAR</li>



        <li class="{{ Request::is('unit')?'active':null}}"><a href="{{URL('unit')}}"><i class="fa fa-asterisk"></i> <span>Daftar Unit & Warna</span></a></li>

<!-- ......................................................................... -->

        <li class="{{ Request::is('leasing')?'active':null}}"><a href="{{URL('leasing')}}"><i class="fa fa-file"></i> <span>Daftar Leasing</span></a></li>

<!-- ......................................................................... -->

        <li class="header">LAPORAN</li>



        <li class="{{ Request::is('report')?'active':null}}"><a href="{{URL('report')}}"><i class="fa fa-angle-double-right"></i> <span>Laporan Stok</span></a></li>   



<!-- ......................................................................... -->

        <li class="header">BOOKING</li>

        @include('menu.link_booking_service')

      </ul>