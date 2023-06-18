@extends('layout.template.template')

{{-- section judul halaman --}}
@section('page-title', 'Daftar Projek')



{{-- section library css halaman --}}
@section('css')
    <link href="{{ asset('assets') }}/libs/dropzone/min/dropzone.min.css" rel="stylesheet" type="text/css" />
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
                            <li class="breadcrumb-item"><a href="{{ route('projects') }}">Projek</a></li>
                            <li class="breadcrumb-item active">{{ $project->project_name }}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{ $project->project_name }}</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card bg-dark text-white">
                    <img id="backgroud-project" src="{{ asset('assets/images/collab.jpg') }}" width="80%"
                        class="card-img" alt="project-header">
                    <div class="card-img-overlay">
                    </div>
                </div>
                <div class="row"style="background-color: white">
                    <div class="col-md-8">
                        <div class="card bg-transparent">
                            <div class="card-body">
                                <ul class="nav nav-tabs nav-bordered nav-justified">
                                    <li class="nav-item">
                                        <a href="#home-b2" data-bs-toggle="tab" aria-expanded="true"
                                            class="nav-link active">
                                            Forum
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#profile-b2" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                                            Tugas
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="home-b2">
                                        <div class="card">
                                            <div class="card-header" id="headingNine">
                                                <h5 class="m-0 position-relative">
                                                    <div class="custom-accordion-title text-reset d-block"
                                                        data-bs-toggle="collapse" href="#collapseNine" aria-expanded="true"
                                                        aria-controls="collapseNine">
                                                        <a href="#" class="avatar-group-item" data-bs-toggle="tooltip"
                                                            data-bs-placement="top" title={{ Auth::user()->name }}>
                                                            <img src="{{ asset('image_user/' . Auth::user()->photo) }}"
                                                                class="rounded-circle avatar-sm" alt="friend" /> Umumkan
                                                            Sesuatu
                                                            kepada
                                                            seluruh team pada Projek Anda!
                                                        </a> <i class="mdi mdi-chevron-down accordion-arrow"></i>
                                                        </a>
                                                </h5>
                                            </div>
                                            <div id="collapseNine" class="collapse" aria-labelledby="headingFour"
                                                data-bs-parent="#custom-accordion-one">
                                                <div class="card-body">
                                                    <h4>Buat Postingan</h4>
                                                    <textarea name="editor1" id="editor1">&lt;p&gt;&lt;/p&gt;</textarea>
                                                    <div class="dropzone-previews mt-3" id="file-previews"></div>
                                                    <div class="d-flex flex-row-reverse m-2 justify-content-between">
                                                        <div class="">
                                                            <button id="post_button" onclick="post()"
                                                                class="btn btn-primary">Posting</button>
                                                        </div>
                                                        <div class="">
                                                            <a class="btn btn-info" data-bs-toggle="modal"
                                                                data-bs-target="#exampleModal" title="Lampirkan FIle"> <i
                                                                    class="fe-upload"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @foreach ($project->postingan as $postingan)
                                            <div class="card">
                                                <div class="card-header" id="headingNine">
                                                    <h5 class="m-0">
                                                        <div class="avatar-group-item" title="">
                                                            <img src="{{ asset('image_user/' . $postingan->author->photo) }}"
                                                                class="rounded-circle avatar-sm" alt="friend" />
                                                            {{ $postingan->author->name }} - {{ $postingan->created_at }}
                                                        </div>
                                                    </h5>
                                                </div>
                                                <div class="card-body mt-0" style="background-color: #d3e7ff">
                                                    @if ($postingan->id_user === Auth::user()->id)
                                                        <div class="dropdown float-end">
                                                            <a href="#" class="dropdown-toggle arrow-none card-drop"
                                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="mdi mdi-dots-vertical"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <!-- item-->
                                                                <a href="#"
                                                                    onclick='deletePost(`{{ route('post.delete', $postingan->id) }}`)'
                                                                    class="dropdown-item"> <i class="fe-trash-2"></i>
                                                                    Hapus</a>
                                                                <!-- item-->
                                                            </div>
                                                        </div>
                                                    @endif
                                                    {!! $postingan->konten !!}
                                                    <div class="">
                                                        @if ($postingan->files->count() > 0)
                                                            <div class="text-muted">Lampiran</div>
                                                            <ul class="list-group">
                                                                @foreach ($postingan->files as $file)
                                                                    <li class="list-group-item">{{ $file->file_name }} -
                                                                        <a href="{{ route('downloadFile', $file->file_name) }}"
                                                                            class="fe-download"></a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    </div>
                                                    <button class="btn-primary btn-block btn"
                                                        onclick="showChatModal('{{ $postingan->id }}')"> <i
                                                            class="fe-message-square"></i>
                                                        Obrolan <span class="badge bg-danger"></button>
                                                    <button class="btn-info btn-block btn"
                                                        onclick="showTaskModal('{{ $postingan->id }}','{{ $project->id }}')">
                                                        <i class="fe-clipboard"></i>
                                                        Tugas</button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="tab-pane" id="profile-b2">
                                        <div class="card">
                                            <div class="card-header p-3">
                                                <h5 class="mb-0"><i class="fas fa-tasks me-2"></i>Daftar Tugas</h5>
                                            </div>
                                            <div class="card-body" data-mdb-perfect-scrollbar="true" style="background-color: #d3e7ff">

                                                <table class="table mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Tugas</th>
                                                            <th scope="col">Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="table-tugas">


                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card" style="background-color: #fed9f2">
                            <div class="card-body">
                                <h5 class="card-title">Kode Bergabung</h4>
                                    <h1 class="text-center">{{ $project->invite_code }}</h1>

                            </div>
                        </div>
                        <div class="card" style="background-color: #f2cefa">
                            <div class="card-body">
                                <h5 class="card-title">Progress Projek</h4>
                                    <h5>Tugas selesai <span class="text-primary float-end" id="progress_value">45%</span>
                                    </h5>
                                    <div class="progress progress-bar-alt-primary progress-sm">
                                        <div id="progress_present"
                                            class="progress-bar bg-primary progress-animated wow animated animated"
                                            role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"
                                            style="width: 45%;">
                                        </div><!-- /.progress-bar .progress-bar-danger -->
                                    </div>
                                    <p class="text-mute" id="progress_display">10 dari 15 Tugas selesai</p>

                            </div>
                        </div>

                        <div class="card" style="background-color: #d3e7ff">
                            <div class="card-body">
                                <h4 class="header-title mt-0 mb-3">Tim Saya</h4>
                                <ul class="list-group mb-0 user-list">
                                    @foreach ($project->team as $team)
                                        <li class="list-group-item">
                                            <a href="{{ route("profile",$team->id) }}" class="user-list-item">
                                                <div class="user avatar-sm float-start me-2">
                                                    <img src="{{ asset('image_user/' .$team->photo) }}"
                                                    class="rounded-circle avatar-sm" alt="friend" />
                                                </div>
                                                <div class="user-desc">
                                                    <h5 class="name mt-0 mb-1">{{ $team->name }}</h5>
                                                    <p class="desc text-muted mb-0 font-12">
                                                        {{ $project->author == $team->id ? 'Author' : 'Team' }}</p>
                                                </div>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h4 class="card-title">Lampirkan File</h4>
                    <form action="{{ route('upload_files') }}" method="post" class="dropzone" id="myAwesomeDropzone"
                        data-plugin="dropzone" data-previews-container="#file-previews"
                        data-upload-preview-template="#uploadPreviewTemplate">
                        @csrf
                        <div class="fallback">
                            <input name="files" type="file" multiple />
                        </div>
                        <div class="dz-message needsclick">
                            <i class="h1 text-muted dripicons-cloud-upload"></i>
                            <h3>Tarik file ke sini or klik untuk upload.</h3>
                        </div>
                    </form>
                    <div class="dropzone-previews mt-3" id="file-previews"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Selesai</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="chatModal" tabindex="-1" aria-labelledby="chatModal" aria-hidden="true">
        <div class="modal-dialog " aria-hidden="true">
            <div class="modal-content" style="background-color: #fed9f2">
                <div class="modal-header">
                    <h4 class="modal-title">Obrolan Forum</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <ul id="chat-box" class="conversation-list slimscroll overflow-auto" style="height: 410px;"
                            data-simplebar>
                        </ul>
                    </div>
                </div>
                <div class="p-3 conversation-input border-top">
                    <div class="row">
                        <div class="col">
                            <div>
                                <input type="text" class="form-control" id="chatMessage"
                                    placeholder="Enter Message...">
                                <input type="hidden" class="form-control" id="idPost">
                            </div>
                        </div>
                        <div class="col-auto">
                            <button onclick="sendChat()"
                                class="btn btn-primary chat-send width-md waves-effect waves-light"><span
                                    class="d-none d-sm-inline-block me-2" id="send_loading_chat">Kirim</span> <i
                                    class="mdi mdi-send"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="taskModal" tabindex="-1" aria-labelledby="taskModal" aria-hidden="true">
        <div class="modal-dialog " aria-hidden="true">
            <div class="modal-content" style="background-color: #f2cefa">
                <div class="modal-header">
                    <h4 class="modal-title">Daftar Tugas</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="">
                        <div class="d-flex flex-row align-items-center">
                            <input type="text" class="form-control" id="task" placeholder="Tambahkan Tugas">
                            <input type="hidden" name="id_post" id="id_post_task">
                            <input type="hidden" name="project_id" id="id_post_task_project">
                            <div class="d-flex flex-row">
                                <button type="button" onclick="addTask()" class="btn btn-primary mx-1"> <i
                                        class="fe-plus"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="mx-1" id="listGroup">

                    </div>
                    <div class="mx-1" id="listGroupFinish">

                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>


    </div>



    </div> <!-- container-fluid -->
@endsection


@section('js')

    <script src="{{ asset('assets/libs/ckeditor_basic/ckeditor.js') }}"></script>
    <script src="{{ asset('assets') }}/libs/dropzone/min/dropzone.min.js"></script>
    <script src="{{ asset('assets/js/js_pages/detail_project.js') }}"></script>

    <script>
        var idProject = {{ $project->id }}
        getProgress(idProject);

        function appendAllproject(element) {
            
            return ` <tr class="fw-normal">
                                                            <td class="align-middle">
                                                                <span>`+element.task+`</span>
                                                            </td>
                                                            <td class="align-middle">
                                                                <a href="#!" data-mdb-toggle="tooltip"
                                                                    title="Done"><i
                                                                        class="`+(element.finish == true ? "fe-check" : "fe-alert-circle")+` `+(element.finish == true ? "text-success" : "text-warning")+` me-3"></i>`+(element.finish == true ? "Belum Selesai" : "Selesai")+`</a>
                                                            </td>
                                                        </tr>`
        }

        function getProgress(idProject) {

            var progress = $("#progress_value")
            var progress_bar = $("#progress_present")
            var progress_display = $("#progress_display")

            $.ajax({
                url: "{{ route('task.getAll') }}",
                type: "POST",
                data: {
                    "project_id": idProject,
                    "_token": "{{ csrf_token() }}",
                },
                success: function(response) {
                    var count = response.length
                    var count_finish = 0
                    var count_progres = 0
                    html = '';
                    response.forEach(element => {
                        html += appendAllproject(element);
                        if (element.finish == 1) {
                            count_finish++
                        } else {
                            count_progres++
                        }
                    });
                    $("#table-tugas").html(html);
                    var count_progress_value = ((count_finish / count) * 100)
                    progress_display.text("Tugas selesai " + count_finish + " dari " + count)
                    progress_bar.css("width", ((count_finish / count) * 100) + "%")
                    progress.text(((count_finish / count) * 100).toFixed(1) + "%")
                },
                error: function(xhr, status, error) {

                    alertSet("danger", "Error", "Terjadi kesalahan, silahkan coba lagi");
                }
            });
        }

        function showTaskModal(idPost, projectId) {
            $("#taskModal").modal("show");
            $("#id_post_task").val(idPost);
            $("#id_post_task_project").val(projectId);
            getTaskData(idPost)
        }

        function getTaskData(idPost) {
            var listgroup = $("#listGroup");
            var listgroutFinish = $("#listGroupFinish");
            $.ajax({
                url: "{{ route('task.get') }}",
                type: "POST",
                data: {
                    "post_id": idPost,
                    "_token": "{{ csrf_token() }}",
                },
                success: function(response) {
                    var htmlFinish = ``;
                    var html = ``;
                    getProgress(idProject)
                    response.forEach(element => {
                        if (element.finish == true) {
                            htmlFinish += listViewModel(element.task, element.finish, element
                                .created_at, element.id, element.user_id, idPost);
                        } else {
                            html += listViewModel(element.task, element.finish, element.created_at,
                                element.id, element.user_id, idPost);
                        }
                    });
                    listgroutFinish.html(htmlFinish);
                    listgroup.html(html);
                },
                error: function(xhr, status, error) {

                    alertSet("danger", "Error", "Terjadi kesalahan, silahkan coba lagi");
                }
            });
        }
        333

        function addTask() {
            var idPost = $("#id_post_task").val();
            var task = $("#task").val();
            var idProject = $("#id_post_task_project").val();
            if (task == '') {
                alertSet("error", "gagal", "Tugas tidak boleh kosong!");

            } else {
                $.ajax({
                    url: "{{ route('task.create') }}",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id_post": idPost,
                        "project_id": idProject,
                        "task": task,
                    },
                    success: function(response) {
                        if (response.status == true) {
                            alertSet("success", "Berhasil", response.message);
                            $("#task").val('');
                            getTaskData(idPost)

                        } else {
                            alertSet("error", "Gagal", response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        if (xhr.status === 500) {
                            alertSet("error", "Kesalahan Server", "Silahkan coba lagi nanti");
                        } else if (xhr.status === 419) {
                            alertSet("error", "Sesi tidak valid", "Silahkan muat ulang halaman dan coba lagi");
                        } else {
                            alertSet("error", "Error", "Terjadi kesalahan, silahkan coba lagi");
                        }
                    }
                });
            }

        }

        function checked_task(id) {
            $.ajax({
                url: "{{ route('task.check') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id
                },
                success: function(response) {
                    if (response.status == true) {
                        alertSet("success", "Berhasil", response.message);
                        getTaskData(response.id_post)
                    } else {
                        alertSet("error", "Gagal", response.message);
                    }
                },
                error: function(xhr, status, error) {
                    if (xhr.status === 500) {
                        alertSet("error", "Kesalahan Server", "Silahkan coba lagi nanti");
                    } else if (xhr.status === 419) {
                        alertSet("error", "Sesi tidak valid", "Silahkan muat ulang halaman dan coba lagi");
                    } else {
                        alertSet("error", "Error", "Terjadi kesalahan, silahkan coba lagi");
                    }
                }
            });
        }

        function deleteTask(id, idPost) {
            $.ajax({
                url: "{{ route('task.delete') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id
                },
                success: function(response) {
                    if (response.status == true) {
                        alertSet("success", "Berhasil", response.message);
                        getTaskData(idPost)
                    } else {
                        alertSet("error", "Gagal", response.message);
                    }
                },
                error: function(xhr, status, error) {
                    if (xhr.status === 500) {
                        alertSet("error", "Kesalahan Server", "Silahkan coba lagi nanti");
                    } else if (xhr.status === 419) {
                        alertSet("error", "Sesi tidak valid", "Silahkan muat ulang halaman dan coba lagi");
                    } else {
                        alertSet("error", "Error", "Terjadi kesalahan, silahkan coba lagi");
                    }
                }
            });
        }

        function listViewModel(task, checked, created_at, id, user_id, idPost) {
            var dateTime = new Date(created_at);
            var date = dateTime.getDate() + "/" + (dateTime.getMonth() + 1) + "/" + dateTime.getFullYear();
            var checked_stat = checked == true ? "checked" : "";
            var finsihIcon = checked == true ? "fe-check" : "fe-alert-circle"
            var isAuthor = "{{ Auth::user()->id }}" == user_id ? `  
                                    <a href="#!" onclick="deleteTask(` + id + `,` + idPost + `)" class="text-danger mx-1" data-mdb-toggle="tooltip"
                                        title="Delete todo"><i class="fe-trash-2"></i></a>` : ``;
            return `
            
            <ul class="list-group list-group-horizontal rounded-0 bg-transparent">
                            <li
                                class="list-group-item d-flex align-items-center ps-0 pe-3 rounded-0 border-0 bg-transparent">
                                <div class="form-check">
                                    <input onchange="checked_task(` + id + `)" class="form-check-input me-0" type="checkbox" value=""
                                        id="task_project_check" aria-label="..." ` + checked_stat + ` />

                                </div>
                            </li>
                            <li
                                class="list-group-item px-3 d-flex align-items-center flex-grow-1 border-0 bg-transparent">
                                <p class="">` + task + `</p>
                            </li>
                            <li class="list-group-item ps-3 pe-0 rounded-0 border-0 bg-transparent">
                                <div class="d-flex flex-row justify-content-end mb-1">
                                    <a href="#!" class="` + (checked == true ? "text-success" : "text-warning") +
                `" data-mdb-toggle="tooltip"><i class="` + finsihIcon + `"></i> ` + (checked == true ? "selesai" :
                    "belum selesai") + `</a>
                                    ` + isAuthor + `
                            </div>
                                <div class="text-end text-muted">
                                    <a href="#!" class="text-muted" data-mdb-toggle="tooltip" title="Created date">
                                        <p class="small mb-0"><i class="fe-calendar me-2"></i>` + date + `</p>
                                    </a>
                                </div>
                            </li>
                        </ul>
            `;

        }
    </script>


    <script>
        var fileS_list = [];
        var lastChatId = null;

        function showChatModal(id) {
            $("#chatModal").modal("show");
            lastChatId = null;
            $("#idPost").val(id);
            chatGet(id);

        }

        $('#chatModal').on('shown.bs.modal', function() {
            var id = $("#idPost").val();
            startPolling(id);

        });
        $('#chatModal').on('hidden.bs.modal', function() {
            // Menghentikan polling data dengan menghapus interval polling
            var pollingInterval = $(this).data('pollingInterval');
            clearInterval(pollingInterval);
        });


        function deletePost(id) {
            $.ajax({
                url: id, // Ganti dengan URL yang sesuai untuk penghapusan data
                method: 'GET', // Ganti dengan metode HTTP yang sesuai, seperti POST atau DELETE
                success: function(response) {

                    alertSet("success", "Berhasil", "Berhasil dihapus!");
                },
                error: function(xhr, status, error) {
                    // Callback yang akan dijalankan jika terjadi kesalahan saat penghapusan data
                    console.log('Terjadi kesalahan dalam penghapusan data');
                    console.log(error); // Menampilkan pesan kesalahan jika ada
                    // Lakukan penanganan kesalahan
                }
            });
            location.reload();
        }

        function post() {
            var editorData = CKEDITOR.instances.editor1.getData();
            buttonState("#post_button", "disable");
            $.ajax({
                url: "{{ route('post.create') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "konten": editorData,
                    "file_list": JSON.stringify(fileS_list),
                    "project_id": "{{ $project->id }}"
                },
                success: function(response) {
                    if (response.status) {
                        alertSet("success", "Berhasil", response.message);
                        $("#kode").val('');
                        $('#centermodal').modal('hide');
                        CKEDITOR.instances.editor1.setData('');

                    } else {
                        alertSet("error", "Gagal", response.message);
                    }
                    buttonState("#post_button", "enable", "Posting");
                },
                error: function(xhr, status, error) {
                    alertSet("danger", "Error", "Terjadi kesalahan, silahkan coba lagi");
                    buttonState("#post_button", "enable", "posting");

                }


            });
            buttonState("#post_button", "enable");
            location.reload();
        }

        function addAndUpdateList(fileName) {
            fileS_list.push(fileName)

        }

        function removeFromList(filename) {
            for (let index = 0; index < fileS_list.length; index++) {
                console.log(fileS_list[index] + "|" + filename);
                if (fileS_list[index] === filename) {
                    console.log("delete =" + filename)
                    fileS_list.splice(index, 1);
                }
            }
            console.log("delete = " + fileS_list);
        }


        Dropzone.options.myAwesomeDropzone = {
            // Konfigurasi Dropzone lainnya
            addRemoveLinks: true,
            success: function(file, response) {
                // File berhasil diunggah dan respons diterima dari server
                console.log(file)
                addAndUpdateList(response);

                // Jika respons dari server berisi informasi tambahan, Anda dapat mengaksesnya seperti ini:
                var fileName = response.fileName;
                var fileSize = response.fileSize;

                // Lakukan tindakan lain yang diperlukan dengan respons dari server
            },

            complete: function(file) {
                // File berhasil diunggah dan respons diterima dari server (termasuk respons kesalahan)
                console.log(file.xhr.responseText); // Menampilkan respons dari server

                // Lakukan tindakan lain yang diperlukan dengan respons dari server
            },

            removedfile: function(file) {
                // Menghapus file dari server
                var fileName = file.name;
                removeFromList("{{ Auth::user()->id }}" + "_" + fileName);
                // Kirim permintaan Ajax ke server untuk menghapus file
                $.ajax({
                    url: '{{ route('deleteFiles') }}',
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        fileName: fileName
                    },
                    success: function(response) {
                        console.log(response); // Menampilkan respons dari server setelah file dihapus
                        var _ref;
                        return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file
                            .previewElement) : void 0;
                        // Lakukan tindakan lain yang diperlukan setelah file dihapus
                    },
                    error: function(xhr, status, error) {
                        console.log(
                            error
                        ); // Menampilkan pesan kesalahan jika terjadi kesalahan saat menghapus file
                    }
                });
            }
        };

        function chatGet(id) {
            $("#chat-box").html("")
            $.ajax({
                url: "{{ route('chat.get') }}",
                type: "POST",
                data: {
                    "id": id,
                    "_token": "{{ csrf_token() }}",
                },
                success: function(response) {
                    var data = response;
                    var html = "";
                    var userId = '{{ Auth::user()->id }}'
                    lastChatId = response[response.length - 1].id
                    data.forEach(element => {
                        var odd = userId == element.user_id ? "odd" : "";
                        var dateTime = new Date(element.created_at);
                        var hour = dateTime.getHours();
                        var minute = dateTime.getMinutes();
                        html += `
                    <li class="` + odd + `">
                                <div class="message-list">
                                    <div class="chat-avatar">
                                        <img src="{{ asset('/image_user') }}/` + element.user.photo + `" alt="">
                                    </div>
                                    <div class="conversation-text">
                                        <div class="ctext-wrap">
                                            <span class="user-name">` + element.user.name + `</span>
                                            <p>
                                               ` + element.chat + `
                                            </p>
                                        </div>
                                        <span class="time">` + hour + `:` + minute + `</span>
                                    </div>
                                </div>
                            </li>
                    `
                    });
                    $("#chat-box").html(html);

                },
                error: function(xhr, status, error) {

                    alertSet("danger", "Error", "Terjadi kesalahan, silahkan coba lagi");
                }
            });
        }

        function appendChat(id) {
            $.ajax({
                url: "{{ route('chat.get') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id,
                },
                success: function(response) {
                    var data = response.pop();
                    var parent = $("#chat-box");
                    var userId = '{{ Auth::user()->id }}'
                    if (data.id > lastChatId) {
                        var odd = userId == data.user_id ? "odd" : "";
                        var dateTime = new Date(data.created_at);
                        var hour = dateTime.getHours();
                        var minute = dateTime.getMinutes();
                        parent.append(` <li class="` + odd + `">
                                <div class="message-list">
                                    <div class="chat-avatar">
                                        <img src="{{ asset('/image_user') }}/` + data.user.photo + `" alt="">
                                    </div>
                                    <div class="conversation-text">
                                        <div class="ctext-wrap">
                                            <span class="user-name">` + data.user.name + `</span>
                                            <p>
                                               ` + data.chat + `
                                            </p>
                                        </div>
                                        <span class="time">` + hour + `:` + minute + `</span>
                                    </div>
                                </div>
                            </li>`)
                        lastChatId = data.id;
                        $('#chatModal').scrollTop($('#chatModal')[0].scrollHeight);
                    }
                    // buttonState("#post_button", "enable", "Posting");
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }

        function sendChat(id) {
            var chatContent = $("#chatMessage")
            var idPost = $("#idPost")
            // buttonState("#send_loading_chat","disabled","Kirim");
            $.ajax({
                url: "{{ route('chat.send') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "chat": chatContent.val(),
                    "id_post": idPost.val(),
                },
                success: function(response) {
                    buttonState("#post_button", "enable", "Posting");
                    chatContent.val('');
                    // buttonState("#post_button", "enable", "Posting");
                },
                error: function(xhr, status, error) {
                    buttonState("#post_button", "enable", "Posting");
                    alertSet("danger", "Error", "Terjadi kesalahan, silahkan coba lagi");
                }
            });
        }

        function startPolling(id) {
            $('#chatModal').scrollTop($('#chatModal')[0].scrollHeight);
            pool = 0
            var pollingInterval = setInterval(() => {
                pool += 1
                console.log("pool : " + pool)
                appendChat(id);

            }, 1000);

            $('#chatModal').data('pollingInterval', pollingInterval);
        }
    </script>
@endsection
