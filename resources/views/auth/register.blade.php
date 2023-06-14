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

    <!-- icons -->
    <link href="{{ asset('assets') }}/css/icons.min.css" rel="stylesheet" type="text/css" />

</head>

<body style="background-size:cover; background-image: url('/assets/images/bground.png')">

    <div class="account-pages my-5">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-6">
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
                                <h4 class="text-uppercase mt-0">Daftar</h4>
                            </div>

                            <form  id="signUp-form">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input class="form-control" type="text" id="nama" required=""
                                        placeholder="Masukkan  nama lengkap">
                                </div>
                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <input class="form-control" type="text" id="alamat" required=""
                                        placeholder="Masukkan  alamat">
                                </div>
                                <div class="mb-3">
                                    <label for="telepon" class="form-label">Telepon</label>
                                    <input class="form-control" type="number" id="telepon" required=""
                                        placeholder="Masukkan no Telepon">
                                </div>
                                <div class="mb-3">
                                    <label for="emailaddress" class="form-label">Email</label>
                                    <input class="form-control" type="email" id="emailaddress" required=""
                                        placeholder="Masukkan  email">
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input class="form-control" type="password" required="" id="password"
                                        placeholder="Masukkan password">
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">konfirmasi Password</label>
                                    <input class="form-control" type="password" required="" id="passwordConfirm"
                                        placeholder="konfirmasi password">
                                </div>
                                <div class="mb-3 d-grid text-center">
                                    <button id="daftar" type="submit" class="btn btn-info">Daftar</button>
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

    <!-- App js -->
    <script src="{{ asset('assets') }}/js/app.min.js"></script>
    <script>
        $(document).ready(function() {

            function buttonState(state) {
                tombol = $("#daftar");
                if (state == "enable") {
                    tombol.prop("disabled", false);
                    tombol.html("Masuk"); 
                } else {
                    tombol.prop("disabled", true);
                    tombol.html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Mendaftar`);
                }

            }

            function alertSet(type, message) {
                var alertComponent = $("#alert-content");
                alert = `<div class="alert alert-${type} alert-dismissible fade show" role="alert">
                        <i class="mdi mdi-check-all me-2"></i>
                        ${message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>`;
                alertComponent.html(alert);
            }

            $("#signUp-form").submit(function(event) {
                event.preventDefault();
                buttonState("disable");
                $.ajax({
                    url: "{{ route('register') }}",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "name": $("#nama").val(),
                        "address": $("#alamat").val(),
                        "phone": $("#telepon").val(),
                        "password": $("#password").val(),
                        "password_confirm": $("#passwordConfirm").val(),
                        "email": $("#emailaddress").val(),
                    },
                    success: function(response) {
                        if (response.status) {
                            window.location.href = "{{ route('login') }}";
                        } else {
                            alertSet("danger", response.message);
                        }
                        buttonState("enable");
                    },
                    error: function(xhr, status, error) {
                        alertSet("danger", "Terjadi kesalahan, silahkan coba lagi");
                        buttonState("enable");

                    }
                });
            });
        });
    </script>
</body>

</html>
