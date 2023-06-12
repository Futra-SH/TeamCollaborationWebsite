<div class="navbar-custom" style="background-color: #83dcff">
    <ul class="list-unstyled topnav-menu float-end mb-0">

        <li class="d-none d-lg-block">
          
        </li>

        <li class="dropdown d-inline-block d-lg-none">
           
        </li>

        <li class="dropdown notification-list topbar-dropdown">
           
        </li>

        <li class="dropdown notification-list topbar-dropdown">
            <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                @if(Auth::user()->photo != null)
                <img src="{{ asset('image_user/' . Auth::user()->photo) }}" alt="user-image" class="rounded-circle">
                @else
                <img src="{{ asset("assets/images/users/user-2.jpg") }}" alt="user-image" class="rounded-circle">
                @endif
                <span class="pro-user-name ms-1">
                    {{ Auth::user()->name }} <i class="mdi mdi-chevron-down"></i> 
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                <!-- item-->
                <div class="dropdown-header noti-title">
                    <h6 class="text-overflow m-0">Selamat Datang !</h6>
                </div>

                <!-- item-->
                <a href="{{ route("profile",Auth::user()->id) }}" class="dropdown-item notify-item">
                    <i class="fe-user"></i>
                    <span>Akun Saya</span>
                </a>

                <!-- item-->

                <div class="dropdown-divider"></div>

                <!-- item-->
                <a href="#" data-bs-toggle="modal" data-bs-target="#danger-alert-modal" class="dropdown-item notify-item">
                    <i class="fe-log-out"></i>
                    <span>Keluar</span>
                </a>

            </div>
        </li>

    </ul>

    <!-- LOGO -->
    <div class="logo-box">
        <a href="index.html" class="logo logo-light text-center">
            <span class="logo-sm">
                <img src="{{ asset("assets") }}/images/logo-sm.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset("assets") }}/images/logo-light.png" alt="" height="16">
            </span>
        </a>
        <a href="index.html" class="logo logo-dark text-center">
            <span class="logo-sm">
                <img src="{{ asset("assets") }}/images/logo-sm.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset("assets") }}/images/logo-dark.png" alt="" height="16">
            </span>
        </a>
    </div>

    <ul class="list-unstyled topnav-menu topnav-menu-left mb-0">

        <li>
            <!-- Mobile menu toggle (Horizontal Layout)-->
            <a class="navbar-toggle nav-link" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                <div class="lines">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </a>
            <!-- End mobile menu toggle-->
        </li>

    </ul>

    <div class="clearfix"></div> 

    <div class="clearfix"></div> 

</div>

