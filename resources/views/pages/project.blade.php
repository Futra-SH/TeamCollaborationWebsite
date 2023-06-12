@extends('layout.template.template')

{{-- section judul halaman --}}
@section('page-title', 'Daftar Projek')


{{-- section library css halaman --}}
@section('css')
    <link href="{{ asset('assets') }}/libs/quill/quill.core.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets') }}/libs/quill/quill.bubble.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets') }}/libs/quill/quill.snow.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets') }}/libs/dropzone/min/dropzone.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets') }}/libs/dropify/css/dropify.min.css" rel="stylesheet" type="text/css" />
@endsection

{{-- section content halaman --}}
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);"></a></li>
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">ColabYuk</a></li>
                            <li class="breadcrumb-item active">Daftar Projek</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Daftar Projek</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <a href="#" data-bs-toggle="modal" data-bs-target="#custom-modal" data-animation="fadein"
                    data-plugin="custommodal" data-overlaySpeed="200" data-overlayColor="#36404a"
                    class="btn btn-purple rounded-pill w-md waves-effect waves-light mb-3"><i class="mdi mdi-plus"></i> Buat
                    Projek baru</a>
                <a href="#" data-bs-toggle="modal" data-bs-target="#centermodal" data-animation="fadein"
                    data-plugin="custommodal" data-overlaySpeed="200" data-overlayColor="#36404a"
                    class="btn btn-info rounded-pill w-md waves-effect waves-light mb-3"><i class="mdi mdi-plus"></i>
                    Gabung Projek</a>
            </div>
        </div>
        <!-- end row -->


        <div class="row" id="listProjek">



        </div>
        <!-- end row -->



        <!-- end row -->

    </div> <!-- container-fluid -->

    {{-- model bpx create project --}}
    <div class="modal fade" id="custom-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content" style="background-color: #f6dbff">
                <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Buat Projek baru</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <form method="post" id="form-add-project">
                        <div class="mb-3">
                            <label class="form-label" for="name">Nama Projek</label>
                            <input type="text" class="form-control" id="name" placeholder="" required>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label" for="assign">Deskripsi Projek</label>
                                    <div id="snow-editor" style="height: 200px;">
                                    </div> <!-- end Snow-editor-->
                                </div>
                            </div>
                        </div>

                        <button type="submit" id="button-submit-project"
                            class="btn btn-primary waves-effect waves-light me-1">Buat Projek</button>
                        <button type="button" class="btn btn-danger waves-effect waves-light"
                            data-bs-dismiss="modal">Batalkan</button>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade" id="centermodal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background-color: #d9f2fe">
                <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">Gabung Projek</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" id="form-invite-project">
                        <div class="mb-3">
                            <label class="form-label" for="kode">Kode Bergabung</label>
                            <input type="text" class="form-control" id="kode" placeholder="" required>
                            <small id="emailHelp" class="form-text text-muted">Masukan Kode yang diberikan untuk bergabung
                                pada projek</small>
                        </div>
                        <button type="submit" id="button-invite-project"
                            class="btn btn-primary waves-effect waves-light me-1">Gabung Projek</button>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection


@section('js')
    <script src="assets/libs/quill/quill.min.js"></script>
    <script>
        "use strict";
        var quill = new Quill("#snow-editor", {
            theme: "snow",
            modules: {
                toolbar: [
                    [{
                        font: []
                    }, {
                        size: []
                    }],
                    ["bold", "italic", "underline", "strike"],
                    [{
                        color: []
                    }, {
                        background: []
                    }],
                    [{
                        header: [!1, 1, 2, 3, 4, 5, 6]
                    }, "blockquote", "code-block"],
                    [{
                        list: "ordered"
                    }, {
                        list: "bullet"
                    }, {
                        indent: "-1"
                    }, {
                        indent: "+1"
                    }],
                    ["direction", {
                        align: []
                    }],
                    ["link"],
                    ["clean"]
                ]
            }

        })

        PopulateListProject()

        function buttonState(id, state) {
            var tombol = $(id);
            if (state == "enable") {
                tombol.prop("disabled", false);
                tombol.html("Buat Projek");
            } else {
                tombol.prop("disabled", true);
                tombol.html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Loading...`);
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

        function PopulateListProject() {
            $.ajax({
                url: "{{ route('my_project') }}",
                type: "GET",
                success: function(response) {
                    console.log(response);
                    var id = $("#listProjek");
                    var html = '';
                    var url ="/project/open/";
                    response.forEach(project => {
                        var team = ``
                        project.team.forEach(user => {
                            var photo = user.image;
                            if (photo === '') {
                                photo = '{{asset("assets")}}/images/users/user-2.jpg'
                            }
                            team += `
                        <a href="#" class="avatar-group-item" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="` + user.name + `">
                                    <img src="{{ asset("image_user") }}/` + photo + `" class="rounded-circle avatar-sm"
                                        alt="friend" />
                                </a>
                        `
                        })
                        html += `
                                    <div class="col-xl-4">
                            <div class="card">
                                <div class="card-body project-box">
                                    <h4 class="mt-0"><a href="`+url+project.project_hash+`" class="text-dark">` + project.project_detail
                            .project_name + `</a></h4>
                                    <p class="text-muted font-13">
                                        ` + project.project_detail.project_description + `
                                    </p>

                                    <ul class="list-inline">
                                        <li class="list-inline-item me-4">
                                            <h4 class="mb-0">`+project.project_post+`</h4>
                                            <p class="text-muted">Post</p>
                                        </li>
                                        <li class="list-inline-item">
                                            <h4 class="mb-0">`+project.project_task+`</h4>
                                            <p class="text-muted">Tugas</p>
                                        </li>
                                    </ul>

                                    <div class="project-members mb-2">
                                        <h5 class="float-start me-3">Team :</h5>
                                        <div class="avatar-group">
                                        ` + team + `
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                        `
                    });
                    //    console.log(html)
                    id.html(html)

                },
                error: function(xhr, status, error) {

                }
            });
        }

        $("#form-invite-project").submit(function(e) {
            e.preventDefault();
            buttonState("#button-invite-project", "disable");
            $.ajax({
                url: "{{ route('join') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "projectcode": $("#kode").val(),
                },
                success: function(response) {
                    if (response.status) {
                        alertSet("success", "Berhasil Bergabung", response.message);
                        $("#kode").val('');
                        $('#centermodal').modal('hide');
                        PopulateListProject()
                    } else {
                        alertSet("error", "Gagal Bergabung", response.message);
                    }
                    buttonState("#button-invite-project", "enable");
                },
                error: function(xhr, status, error) {
                    alertSet("danger", "Error", "Terjadi kesalahan, silahkan coba lagi");
                    buttonState("#button-invite-project", "enable");

                }

            })
            buttonState("#button-invite-project", "enable");
        })

        $('#form-add-project').submit(function(e) {
            e.preventDefault();
            buttonState("#button-submit-project", "disable");
            var editorContent = quill.root.innerHTML;
            var name = $('#name').val();
            $.ajax({
                url: "{{ route('store_project') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "project_name": name,
                    "project_description": editorContent,

                },
                success: function(response) {
                    if (response.status) {
                        alertSet("success", "Projek berhasil ditambahkan!", response.message);
                        PopulateListProject()

                        //    $('#custom-modal').modal('hide');
                    } else {
                        alertSet("error", "Projek gagal ditambahkan", response.message);
                    }
                    $('#custom-modal').modal('hide');
                    buttonState("#button-submit-project", "enable");
                },
                error: function(xhr, status, error) {
                    alertSet("danger", "Error", "Terjadi kesalahan, silahkan coba lagi");
                    buttonState("#button-submit-project", "enable");

                }
            })
        });
    </script>
@endsection
