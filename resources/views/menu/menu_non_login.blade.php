      <!-- sidebar menu: : style can be found in sidebar.less -->

      <ul class="sidebar-menu" data-widget="tree"> 

        

        @include('menu.link_website')

        <li class="{{ Request::is('stok/AA0104F')?'active':null}}"><a href="{{URL('stok/AA0104F')}}"><i class="fa fa-angle-double-right"></i> <span>Flagship Shop Denpasar</span></a></li>

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

      </ul>