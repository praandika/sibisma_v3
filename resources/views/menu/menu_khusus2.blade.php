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
        {{ Request::is('stok/AA0104')?'active':null}}
        {{ Request::is('stok/AA0107')?'active':null}}
        {{ Request::is('stok/AA0104F')?'active':null}}">
          <a href="#">
            <i class="fa fa-motorcycle"></i> <span>Stok</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ Request::is('stok/AA0104')?'active':null}}"><a href="{{URL('stok/AA0104')}}"><i class="fa fa-angle-double-right"></i> <span>Bisma Hasanuddin</span></a></li>
            <li class="{{ Request::is('stok/AA0107')?'active':null}}"><a href="{{URL('stok/AA0107')}}"><i class="fa fa-angle-double-right"></i> <span>Bisma Mandiri</span></a></li>
            <li class="{{ Request::is('stok/AA0104F')?'active':null}}"><a href="{{URL('stok/AA0104F')}}"><i class="fa fa-angle-double-right"></i> <span>Flagship Shop Denpasar</span></a></li>
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