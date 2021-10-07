      <!-- sidebar menu: : style can be found in sidebar.less -->

      <ul class="sidebar-menu" data-widget="tree"> 



        @include('menu.link_website')



<!-- ......................................................................... -->

        <li class="header">INVENTORY</li>



        <li class="{{ Request::is('inventory')?'active':null}}"><a href="{{URL('inventory')}}"><i class="fa fa-area-chart"></i> <span>Dashboard</span></a></li>

<!-- ......................................................................... -->  

        <li class="{{ Request::is('dealer')?'active':null}}"><a href="{{URL('dealer')}}"><i class="fa fa-home"></i> <span>Data Dealer</span></a></li>

<!-- ......................................................................... -->      

        <li class="treeview 

        {{ Request::is('stok/AA0101')?'active':null}}

        {{ Request::is('stok/AA0102')?'active':null}}

        {{ Request::is('stok/AA0105')?'active':null}}

        {{ Request::is('stok/AA0106')?'active':null}}

        {{ Request::is('stok/AA0108')?'active':null}}

        {{ Request::is('stok/AA0109')?'active':null}}">

          <a href="#">

            <i class="fa fa-motorcycle"></i> <span>Stok</span>

            <span class="pull-right-container">

              <i class="fa fa-angle-left pull-right"></i>

            </span>

          </a>

          <ul class="treeview-menu">

            <li class="{{ Request::is('stok/AA0101')?'active':null}}"><a href="{{URL('stok/AA0101')}}"><i class="fa fa-angle-double-right"></i> <span>Bisma Sentral</span></a></li>

            <li class="{{ Request::is('stok/AA0102')?'active':null}}"><a href="{{URL('stok/AA0102')}}"><i class="fa fa-angle-double-right"></i> <span>Bisma Cokro</span></a></li>

            <li class="{{ Request::is('stok/AA0105')?'active':null}}"><a href="{{URL('stok/AA0105')}}"><i class="fa fa-angle-double-right"></i> <span>Bisma TTS</span></a></li>

            <li class="{{ Request::is('stok/AA0106')?'active':null}}"><a href="{{URL('stok/AA0106')}}"><i class="fa fa-angle-double-right"></i> <span>Bisma Imbo</span></a></li>

            <li class="{{ Request::is('stok/AA0108')?'active':null}}"><a href="{{URL('stok/AA0108')}}"><i class="fa fa-angle-double-right"></i> <span>Bisma WR Supratman</span></a></li>

            <li class="{{ Request::is('stok/AA0109')?'active':null}}"><a href="{{URL('stok/AA0109')}}"><i class="fa fa-angle-double-right"></i> <span>Bisma Sunset Road</span></a></li>

          </ul>

        </li>

        

        <li class="header">LAPORAN</li>      



        <li class="treeview

        {{ Request::is('report')?'active':null}}

        {{ Request::is('report/unit')?'active':null}}">

          <a href="#">

            <i class="fa fa-file-text"></i> <span>Laporan</span>

            <span class="pull-right-container">

              <i class="fa fa-angle-left pull-right"></i>

            </span>

          </a>

          <ul class="treeview-menu">

            <li class="{{ Request::is('report')?'active':null}}"><a href="{{URL('report')}}"><i class="fa fa-angle-double-right"></i> <span>Laporan Stok</span></a></li>

            <li class="{{ Request::is('report/unit')?'active':null}}"><a href="{{URL('report/unit')}}"><i class="fa fa-angle-double-right"></i> <span>Stok Unit</span></a></li>

          </ul>

        </li>

      </ul>