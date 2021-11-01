<ul class="nav nav-primary">
    <!-- ------------------------------------------ -->
    @include('menu.link_website')
    <!-- ------------------------------------------ -->
    <li class="nav-section">
        <span class="sidebar-mini-icon">
            <i class="fa fa-ellipsis-h"></i>
        </span>
        <h4 class="text-section">INVENTORY</h4>
    </li>
    <!-- ------------------------------------------ -->
    <li class="nav-item {{ Request::is('inventory')?'active':null}}">
        <a href="{{URL('inventory')}}" aria-expanded="false">
            <i class="fas fa-chart-line"></i>
            <p>Dashboard</p>
        </a>
    </li>
    <!-- ------------------------------------------ -->
    <li class="nav-item {{ Request::is('dealer')?'active':null}}">
        <a href="{{URL('dealer')}}" aria-expanded="false">
            <i class="fas fa-home"></i>
            <p>Data Dealer</p>
        </a>
    </li>
    <!-- ------------------------------------------ -->
    <li class="nav-item {{ Request::is('manpower',Session::get('kode_dealer'))?'active':null}}">
        <a href="{{URL('manpower',Session::get('kode_dealer'))}}" aria-expanded="false">
            <i class="fas fa-users"></i>
            <p>Data Manpower</p>
        </a>
    </li>
    <!-- ------------------------------------------ -->
    <li class="nav-item {{ Request::is('stok',Session::get('kode_dealer'))?'active':null}}">
        <a href="{{URL('stok',Session::get('kode_dealer'))}}" aria-expanded="false">
        <i class="fas fa-motorcycle"></i>
            <p>Stok</p>
        </a>
    </li>
    <!-- ------------------------------------------ -->
    <li class="nav-item {{ Request::is('fands',Session::get('kode_dealer'))?'active':null}}">
        <a href="{{URL('fands',Session::get('kode_dealer'))}}" aria-expanded="false">
        <i class="fas fa-pencil-alt"></i>
            <p>Catat Stok</p>
        </a>
    </li>
    <!-- ------------------------------------------ -->
    <li class="nav-item {{ Request::is('opname/stok/',Session::get('kode_dealer'))?'active':null}}">
        <a href="{{URL('opname/stok/'.$now,Session::get('kode_dealer'))}}" aria-expanded="false">
        <i class="fas fa-warehouse"></i>
            <p>Stok Opname</p>
        </a>
    </li>
    <!-- ------------------------------------------ -->
    <li class="nav-section">
        <span class="sidebar-mini-icon">
            <i class="fa fa-ellipsis-h"></i>
        </span>
        <h4 class="text-section">LAPORAN</h4>
    </li>
    <!-- ------------------------------------------ -->
    <li class="nav-item
    {{ Request::is('report')?'active':null}}
    {{ Request::is('report/riil')?'active':null}}
    {{ Request::is('report/unit')?'active':null}}">
        <a data-toggle="collapse" href="#laporan">
            <i class="fas fa-file-alt"></i>
            <p>Laporan</p>
            <span class="caret"></span>
        </a>
        <div class="collapse" id="laporan">
            <ul class="nav nav-collapse">
                <li class="{{ Request::is('report')?'active':null}}">
                    <a href="{{URL('report')}}">
                        <span class="sub-item">Laporan Stok</span>
                    </a>
                </li>
                <li class="{{ Request::is('report/riil')?'active':null}}">
                    <a href="{{URL('report/riil')}}">
                        <span class="sub-item">Laporan Riil</span>
                    </a>
                </li>
                <li class="{{ Request::is('report/unit')?'active':null}}">
                    <a href="{{URL('report/unit')}}">
                        <span class="sub-item">Laporan Unit</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>
    <!-- ------------------------------------------ -->
    <li class="nav-section">
        <span class="sidebar-mini-icon">
            <i class="fa fa-ellipsis-h"></i>
        </span>
        <h4 class="text-section">BOOKING</h4>
    </li>
    <!-- ------------------------------------------ -->
    @include('menu.link_booking_service')
</ul>