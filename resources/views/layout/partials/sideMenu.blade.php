<div class="topnav">
    <div class="container-fluid">
        <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

            <div class="collapse navbar-collapse" id="topnav-menu-content">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link arrow-none" href="{{ route('dashboard') }}" id="topnav-dashboard" role="button"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-view-dashboard me-1"></i> Dasbor
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link arrow-none" href="{{ route('projects') }}" id="topnav-dashboard"
                            role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-buffer me-1"></i> Ruang Kerja
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link arrow-none" href="#" id="topnav-dashboard"
                            role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-account-multiple me-1"></i> Rekan Tim
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link arrow-none" href="{{ route('calendar-event') }}" id="topnav-dashboard"
                            role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-calendar-multiple-check me-1"></i> Jadwal
                        </a>
                    </li>
                </ul> <!-- end navbar-->
            </div> <!-- end .collapsed-->
        </nav>
    </div> <!-- end container-fluid -->
</div> <!-- end topnav-->
