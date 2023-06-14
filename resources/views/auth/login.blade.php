<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Log In | ColabYuk</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets') }}/images/favicon.ico">

    <!-- App css -->
    <link href="{{ asset('assets') }}/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />
    <link href="{{ asset('assets') }}/libs/toastr/build/toastr.min.css" rel="stylesheet" type="text/css" />
    
    <!-- icons -->

    <link href="{{ asset('assets') }}/css/icons.min.css" rel="stylesheet" type="text/css" />

</head>

<body style="background-size:cover; background-image: url('/assets/images/background.png') ">

    <div class="account-pages my-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-4">
                    <div class="text-center">
                        <a href="index.html">
                            {{-- <img src="{{ asset("assets") }}/images/logo-dark.png" alt="" height="22" class="mx-auto"> --}}
                            <h1>ColabYuk</h1>
                        </a>
                        <p class="text-muted mt-2 mb-4">Website Kolaborasi</p>

                    </div>
                    <div class="card">
                        <div class="card-body p-4">

                            <div class="text-center mb-4">
                                <h4 class="text-uppercase mt-0">Masuk</h4>
                            </div>

                            <form id="signUp-form">
                                <div class="mb-3">
                                    <label for="emailaddress" class="form-label">Email</label>
                                    <input class="form-control" type="email" id="email" required=""
                                        placeholder="Masukkan  email">
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input class="form-control" type="password" required="" id="password"
                                        placeholder="Masukkan password">
                                </div>

                                <div class="mb-3">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="checkbox-signin" checked>
                                        <label class="form-check-label" for="checkbox-signin">Ingat saya</label>
                                    </div>
                                </div>

                                <div class="mb-3 d-grid text-center">
                                    <button class="btn btn-primary" id="tombol-masuk" type="submit"> Masuk </button>
                                </div>
                                <hr>
                                <p class="text-center text-muted">Belum Memiliki akun?</p>
                                <div class="mb-3 d-grid text-center">
                                    <a href="{{ route("register") }}" class="btn btn-outline-info">Daftar</a>
                                </div>
                            </form>

                        </div> <!-- end card-body -->
                    </div>
                    <!-- end card -->

                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->

    <!-- Vendor -->
    <script src="{{ asset('assets') }}/libs/jquery/jquery.min.js"></script>
    <script src="{{ asset('assets') }}/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets') }}/libs/simplebar/simplebar.min.js"></script>
    <script src="{{ asset('assets') }}/libs/node-waves/waves.min.js"></script>
    <script src="{{ asset('assets') }}/libs/waypoints/lib/jquery.waypoints.min.js"></script>
    <script src="{{ asset('assets') }}/libs/jquery.counterup/jquery.counterup.min.js"></script>
    <script src="{{ asset('assets') }}/libs/feather-icons/feather.min.js"></script>
 <!-- Toastr js -->
 <script src="{{ asset('assets') }}/libs/toastr/build/toastr.min.js"></script>

 <script src="{{ asset('assets') }}/js/pages/toastr.init.js"></script>
    <!-- App js -->
    <script src="{{ asset('assets') }}/js/app.min.js"></script>
    <script>
        $(document).ready(function() {

            function buttonState(state) {
                tombol = $("#tombol-masuk");
                if (state == "enable") {
                    tombol.prop("disabled", false);
                    tombol.html("Masuk");
                } else {
                    tombol.prop("disabled", true);
                    tombol.html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Autentifikasi`);
                }

            }

            function alertSet(type, title, message) {
                Command: toastr[type](message,
                    title)

                toastr.options = {
                    "closeButton": true,
                    "debug": true,
                    "newestOnTop": true,
                    "progressBar": true,
                    "positionClass": "toast-top-center",
                    "preventDuplicates": true,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }

            }

            $("#signUp-form").submit(function(event) {
                event.preventDefault();
                buttonState("disable");
                $.ajax({
                    url: "{{ route('authenticate') }}",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "email": $("#email").val(),
                        "password": $("#password").val(),
                        "remember": $("input[type='checkbox']").is(":checked") ? "1" : "0"
                    },
                    success: function(response) {
                        if (response.status) {
                            alertSet("success", "Autentikasi Berhasil", response.message);
                            window.location.href = "{{ route('dashboard') }}";
                        } else {
                            alertSet("error", "Autentikasi Gagal", response.message);
                        }
                        buttonState("enable");
                    },
                    error: function(xhr, status, error) {
                        alertSet("danger","Error","Terjadi kesalahan, silahkan coba lagi");
                        buttonState("enable");

                    }
                });
            });
        });
    </script>
</body>

</html>
