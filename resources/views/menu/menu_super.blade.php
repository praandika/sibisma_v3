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
    <li class="nav-item active">
        <a href="{{URL('inventory')}}" aria-expanded="false">
            <i class="fas fa-chart-line"></i>
            <p>Dashboard</p>
        </a>
    </li>
    <!-- ------------------------------------------ -->
    <li class="nav-item">
        <a href="{{URL('dealer')}}" aria-expanded="false">
            <i class="fas fa-home"></i>
            <p>Data Dealer</p>
        </a>
    </li>
    <!-- ------------------------------------------ -->
    <li class="nav-item">
        <a href="{{URL('manpower/')}}" aria-expanded="false">
            <i class="fas fa-users"></i>
            <p>Data Manpower</p>
        </a>
    </li>
    <!-- ------------------------------------------ -->
    <li class="nav-item">
        <a data-toggle="collapse" href="#datastok">
            <i class="fas fa-motorcycle"></i>
            <p>Stok</p>
            <span class="caret"></span>
        </a>
        <div class="collapse" id="datastok">
            <ul class="nav nav-collapse">
                <li>
                    <a href="{{URL('stok/AA0101')}}">
                        <span class="sub-item">Bisma Sentral</span>
                    </a>
                </li>
                <li>
                    <a href="{{URL('stok/AA0102')}}">
                        <span class="sub-item">Bisma Cokro</span>
                    </a>
                </li>
                <li>
                    <a href="{{URL('stok/AA0104')}}">
                        <span class="sub-item">Bisma Hasanudin</span>
                    </a>
                </li>
                <li>
                    <a href="{{URL('stok/AA0105')}}">
                        <span class="sub-item">Bisma TTS</span>
                    </a>
                </li>
                <li>
                    <a href="{{URL('stok/AA0106')}}">
                        <span class="sub-item">Bisma Imbo</span>
                    </a>
                </li>
                <li>
                    <a href="{{URL('stok/AA0107')}}">
                        <span class="sub-item">Bisma Mandiri</span>
                    </a>
                </li>
                <li>
                    <a href="{{URL('stok/AA0108')}}">
                        <span class="sub-item">Bisma Supratman</span>
                    </a>
                </li>
                <li>
                    <a href="{{URL('stok/AA0109')}}">
                        <span class="sub-item">Bisma Sunset</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>
    <!-- ------------------------------------------ -->
    <li class="nav-item">
        <a data-toggle="collapse" href="#catatstok">
            <i class="fas fa-pencil-alt"></i>
            <p>Catat Stok</p>
            <span class="caret"></span>
        </a>
        <div class="collapse" id="catatstok">
            <ul class="nav nav-collapse">
                <li>
                    <a href="{{URL('fands/AA0101')}}">
                        <span class="sub-item">Bisma Sentral</span>
                    </a>
                </li>
                <li>
                    <a href="{{URL('fands/AA0102')}}">
                        <span class="sub-item">Bisma Cokro</span>
                    </a>
                </li>
                <li>
                    <a href="{{URL('fands/AA0104')}}">
                        <span class="sub-item">Bisma Hasanudin</span>
                    </a>
                </li>
                <li>
                    <a href="{{URL('fands/AA0105')}}">
                        <span class="sub-item">Bisma TTS</span>
                    </a>
                </li>
                <li>
                    <a href="{{URL('fands/AA0106')}}">
                        <span class="sub-item">Bisma Imbo</span>
                    </a>
                </li>
                <li>
                    <a href="{{URL('fands/AA0107')}}">
                        <span class="sub-item">Bisma Mandiri</span>
                    </a>
                </li>
                <li>
                    <a href="{{URL('fands/AA0108')}}">
                        <span class="sub-item">Bisma Supratman</span>
                    </a>
                </li>
                <li>
                    <a href="{{URL('fands/AA0109')}}">
                        <span class="sub-item">Bisma Sunset</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>
    <!-- ------------------------------------------ -->
    <li class="nav-item">
        <a data-toggle="collapse" href="#stokopname">
            <i class="fas fa-warehouse"></i>
            <p>Stok Opname</p>
            <span class="caret"></span>
        </a>
        <div class="collapse" id="stokopname">
            <ul class="nav nav-collapse">
                <li>
                    <a href="{{URL('opname/stok/'.$now.'/AA0101')}}">
                        <span class="sub-item">Bisma Sentral</span>
                    </a>
                </li>
                <li>
                    <a href="{{URL('opname/stok/'.$now.'/AA0102')}}">
                        <span class="sub-item">Bisma Cokro</span>
                    </a>
                </li>
                <li>
                    <a href="{{URL('opname/stok/'.$now.'/AA0104')}}">
                        <span class="sub-item">Bisma Hasanudin</span>
                    </a>
                </li>
                <li>
                    <a href="{{URL('opname/stok/'.$now.'/AA0105')}}">
                        <span class="sub-item">Bisma TTS</span>
                    </a>
                </li>
                <li>
                    <a href="{{URL('opname/stok/'.$now.'/AA0106')}}">
                        <span class="sub-item">Bisma Imbo</span>
                    </a>
                </li>
                <li>
                    <a href="{{URL('opname/stok/'.$now.'/AA0107')}}">
                        <span class="sub-item">Bisma Mandiri</span>
                    </a>
                </li>
                <li>
                    <a href="{{URL('opname/stok/'.$now.'/AA0108')}}">
                        <span class="sub-item">Bisma Supratman</span>
                    </a>
                </li>
                <li>
                    <a href="{{URL('opname/stok/'.$now.'/AA0109')}}">
                        <span class="sub-item">Bisma Sunset</span>
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
        <h4 class="text-section">DAFTAR</h4>
    </li>
    <!-- ------------------------------------------ -->
    <li class="nav-item">
        <a href="{{URL('unit')}}" aria-expanded="false">
            <i class="fas fa-tint"></i>
            <p>Daftar Unit & Warna</p>
        </a>
    </li>
    <!-- ------------------------------------------ -->
    <li class="nav-item">
        <a href="{{URL('leasing')}}" aria-expanded="false">
            <i class="fas fa-credit-card"></i>
            <p>Daftar Leasing</p>
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
    <li class="nav-item">
        <a data-toggle="collapse" href="#laporan">
            <i class="fas fa-file-alt"></i>
            <p>Laporan</p>
            <span class="caret"></span>
        </a>
        <div class="collapse" id="laporan">
            <ul class="nav nav-collapse">
                <li>
                    <a href="{{URL('report')}}">
                        <span class="sub-item">Laporan Stok</span>
                    </a>
                </li>
                <li>
                    <a href="{{URL('report/riil')}}">
                        <span class="sub-item">Laporan Riil</span>
                    </a>
                </li>
                <li>
                    <a href="{{URL('report/unit')}}">
                        <span class="sub-item">Laporan Unit</span>
                    </a>
                </li>
                <li>
                    <a href="{{URL('lapor')}}">
                        <span class="sub-item">Buat Lapor Stok</span>
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
    <!-- ------------------------------------------ -->
    <li class="nav-section">
        <span class="sidebar-mini-icon">
            <i class="fa fa-ellipsis-h"></i>
        </span>
        <h4 class="text-section">ADMIN</h4>
    </li>
    <!-- ------------------------------------------ -->
    <li class="nav-item">
        <a href="{{URL('admin')}}" aria-expanded="false">
            <i class="fas fa-user-shield"></i>
            <p>Admin</p>
        </a>
    </li>
    <!-- ------------------------------------------ -->
</ul>