
<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="utf-8" />
        <title>ColabYuk | @yield("page-title")</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset("assets") }}/images/favicon.ico">

        <!-- App css -->

        <link href="{{ asset("assets") }}/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />
        <link href="{{ asset('assets') }}/libs/toastr/build/toastr.min.css" rel="stylesheet" type="text/css" />
        <!-- icons -->
        <link href="{{ asset("assets") }}/css/icons.min.css" rel="stylesheet" type="text/css" />
        @yield("css")
    </head>

    <!-- body start -->
    <body class="loading" data-layout-color="light"  data-layout-mode="horizontal" data-layout-size="fluid" data-topbar-color="light" data-leftbar-position="fixed" data-leftbar-color="light" data-leftbar-size='default' data-sidebar-user='true' style="background-color: rgb(249, 249, 249)">

        <!-- Begin page -->
        <div id="wrapper">


            <!-- Topbar Start -->
            @include("layout.partials.navbar")
            <!-- end Topbar -->

            <!-- ========== Left Sidebar Start ========== -->
            @include("layout.partials.sideMenu")
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->
        
            <div class="content-page">
                <div class="content">
            
                    <!-- Start Content-->
                  @yield("content")
            
                </div> <!-- content -->
            
                @include("layout.partials.footer")
             
            </div>
            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->

        <!-- Right Sidebar -->
       
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>
        @include("layout.partials.components.modal")

        <!-- Vendor -->
        <script src="{{ asset("assets") }}/libs/jquery/jquery.min.js"></script>
        <script src="{{ asset("assets") }}/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset("assets") }}/libs/simplebar/simplebar.min.js"></script>
        <script src="{{ asset("assets") }}/libs/node-waves/waves.min.js"></script>
        <script src="{{ asset("assets") }}/libs/waypoints/lib/jquery.waypoints.min.js"></script>
        <script src="{{ asset("assets") }}/libs/jquery.counterup/jquery.counterup.min.js"></script>
        <script src="{{ asset("assets") }}/libs/feather-icons/feather.min.js"></script>

  
        <script src="{{ asset('assets') }}/libs/toastr/build/toastr.min.js"></script>
        <script src="{{ asset('assets') }}/js/pages/toastr.init.js"></script>
        <!-- App js-->
      
        {{-- page libaray --}}
        @yield("js")
        <script src="{{ asset("assets") }}/js/app.min.js"></script> 

    </body>
</html>