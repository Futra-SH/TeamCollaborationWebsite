@extends('layout.template.template')

{{-- section judul halaman --}}
@section('page-title', 'Dashboard')


{{-- section library css halaman --}}
@section('css')

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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">ColabYuk</a></li>
                            <li class="breadcrumb-item active">Dasbor</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Dasbor</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-4 col-md-6">
                <div class="card" style="background-color: #fed9f2">
                    <div class="card-body">
                        <h4 class="header-title mt-0 mb-4">Projek</h4>

                        <div class="widget-chart-1">
                            <div class="widget-chart-box-1 float-start" dir="ltr">
                                <i class="fe-grid text-info" style="font-size: 70px;"></i>
                            </div>
                            <div class="widget-detail-1 text-end">
                                <h2 class="fw-normal pt-2 mb-1"> {{ $meta['project_count'] }} </h2>
                                <p class="text-muted mb-3">Projek saya</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card" style="background-color: #f7d7ff">
                    <div class="card-body">
                        <h4 class="header-title mt-0 mb-3">Kemajuan Tugas</h4>

                        <div class="widget-box-2">
                            <div class="widget-detail-2 text-end">
                                <span
                                    class="badge bg-success rounded-pill float-start mt-3">{{ $meta['persentasi_selesai'] . '%' }}
                                    <i class="mdi mdi-trending-up"></i> </span>
                                <h2 class="fw-normal mb-1"> {{ count($meta['taskSelesai']) }} </h2>
                                <p class="text-muted mb-3">Tugas Selesai</p>
                            </div>
                            <div class="progress progress-bar-alt-success progress-sm">
                                <div class="progress-bar bg-success" role="progressbar" aria-valuenow="77" aria-valuemin="0"
                                    aria-valuemax="100" style="width: {{ $meta['persentasi_selesai'] . '%' }};">
                                    <span class="visually-hidden">77% Complete</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- end col -->

            <div class="col-xl-8 col-md-6">
                <!-- Hero -->
                <div class="card p-4 shadow-4 rounded-3 mb-3" style="background-color: #d3e7ff">
                    <h2>Selamat Datang, {{ Auth::user()->name }}</h2>
                    <p>
                        Cek Projek yang sedang anda dan tim anda kerjakan, pastikan seluruh tugas sudah dikerjakan dengan
                        baik!
                    </p>
                </div>
                <!-- Hero -->
                <div class="card" style="background-color: #f2cefa">
                    <div class="card-header p-3" style="background-color: #fed9f2">
                        <h5 class="mb-0"><i class="fas fa-tasks me-2"></i>Perlu dikerjakan</h5>
                    </div>
                    <div class="card-body" data-mdb-perfect-scrollbar="true">

                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">Projek</th>
                                    <th scope="col">Tugas</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody id="table-tugas">
                                @foreach ($meta['proses'] as $task)
                                    <tr class="fw-normal">
                                        <td class="align-middle">  <a href="{{ route('project.detail',encrypt($task->project->id)) }}"> <i class="fe-external-link">
                                        </i> {{ $task->project->project_name }}</a>
                                        </td>
                                        <td class="align-middle">
                                            <span>{{$task->task}}</span>
                                        </td>
                                        <td class="align-middle">
                                            <a href="#!" data-mdb-toggle="tooltip" title="Belum selesai"><i
                                                    class="fe-alert-circle text-warning me-3"></i>Perlu Dikerjakan</a>
                                        </td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>

                    </div>
                </div>

            </div><!-- end col -->

        </div>
        <!-- end row -->

        <!-- end row -->


        -->

    </div> <!-- container-fluid -->
@endsection


{{-- section javascript halaman --}}
@section('js')
    <!-- knob plugin -->
    <script src="{{ asset('assets') }}/libs/jquery-knob/jquery.knob.min.js"></script>

    <!--Morris Chart-->
    <script src="{{ asset('assets') }}/libs/morris.js06/morris.min.js"></script>
    <script src="{{ asset('assets') }}/libs/raphael/raphael.min.js"></script>

    <!-- Dashboar init js-->
    <script src="{{ asset('assets') }}/js/pages/dashboard.init.js"></script>
@endsection
