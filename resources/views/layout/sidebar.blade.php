<!-- Sidebar -->
<div class="sidebar sidebar-style-2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <img src="{{ asset('assets/img/profil.jpg') }}" alt="..." class="avatar-img rounded-circle">
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            {{ Session::get('name') }}
                            <span class="user-level">{{ Session::get('akses') }}</span>
                            <span class="caret"></span>
                        </span>
                    </a>
                    <div class="clearfix"></div>

                    <div class="collapse in" id="collapseExample">
                        <ul class="nav">
                            <li>
                                <a href="{{ URL('logout') }}">
                                    <span class="link-collapse">Logout</span>
                                </a>
                            </li>
                        </ul>
                    </div>
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

        </div>
    </div>
</div>
<!-- End Sidebar -->
