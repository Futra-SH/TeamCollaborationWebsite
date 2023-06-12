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

@section("content")
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);"></a></li>
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">ColabYuk</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route("projects") }}">Project</li>
                        <li class="breadcrumb-item active">Daftar Projek</li>
                    </ol>
                </div>
                <h4 class="page-title"> Nama Project </h4>
            </div>
        </div>
    </div>
    <div class="row">

    </div>


</div>


@endsection


@section("js")



@endsection