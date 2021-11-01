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

            @if(Session::get('akses') == "admin")

                @include('menu.menu_admin')

            @elseif(Session::get('akses') == "user")
            
                @include('menu.menu_user')                                                     

            @else

            <li class="nav-section">
                <span class="sidebar-mini-icon">
                    <i class="fa fa-ellipsis-h"></i>
                </span>
                <h4 class="text-section">Anda tidak memiliki akses!</h4>
            </li>

            @endif

            <!-- END MENU -->

        </div>
    </div>
</div>
<!-- End Sidebar -->
