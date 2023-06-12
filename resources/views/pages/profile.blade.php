@extends('layout.template.template')

{{-- section judul halaman --}}
@section('page-title', 'Profile')


{{-- section library css halaman --}}
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/libs/cropter/ijaboCropTool.min.css') }}">
@endsection


@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);"></a></li>
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">ColabYuk</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('projects') }}">Profile</a></li>
                            <li class="breadcrumb-item active">{{ $user->name }}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Profil {{ $user->name }}</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8">
                <div class="card">
                    <div class="bg-picture card-body">
                        <div class="">
                            <div class="flex-grow-1 overflow-hidden">
                                <h4 class="m-0">{{ $user->name }}</h4>
                                <p class="text-muted">{{ $user->email }}</p>
                                <p class="font-13">{!! $user->description !!}
                                </p>
                                <div class="text-start">
                                    <p class="text-muted font-13"><strong>Nama Lengkap :</strong> <span
                                            class="ms-2">{{ $user->name }}</span></p>

                                    <p class="text-muted font-13"><strong>Telpon :</strong><span
                                            class="ms-2">{{ $user->phone }}</span></p>

                                    <p class="text-muted font-13"><strong>Email :</strong> <span
                                            class="ms-2">{{ $user->email }}</span></p>

                                    <p class="text-muted font-13"><strong>Alamat :</strong> <span
                                            class="ms-2">{{ $user->address }}</span></p>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                @if ($user->id == Auth::user()->id)
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mt-0 mb-3"><i class="mdi mdi-notification-clear-all me-1"></i>
                            Ubah Profil</h4>
                        <form action="{{ route('edit_user') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="simpleinput" class="form-label">Nama</label>
                                <input type="text" name="name" value="{{ $user->name }}" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="simpleinput" class="form-label">Deskripsi</label>
                                <textarea name="deskripsi" id="editor1">{!! $user->description !!}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="simpleinput" class="form-label">Email</label>
                                <input type="email" name="email" value="{{ $user->email }}" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="simpleinput" class="form-label">Nomor Telpon</label>
                                <input type="number" name="phone" value="{{ $user->phone }}" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="simpleinput" class="form-label">Alamat</label>
                                <textarea class="form-control" name="address" rows="2">{{ $user->address }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                        </form>

                    </div>
                </div>
                @endif
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mt-0 mb-3"><i class="mdi mdi-notification-clear-all me-1"></i>
                            Foto Profil</h4>
                        <img src="{{ asset('image_user/' . $user->photo) }}"
                            class="rounded-circle text-center img-thumbnail " width="200px" alt="gambar bundar">
                        @if ($user->id == Auth::user()->id)
                            <input type="file" class="form-control m-2" name="photo" id="foto">
                        @endif
                    </div>
                </div>
                @if ($user->id == Auth::user()->id)
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title mt-0 mb-3"><i class="mdi mdi-notification-clear-all me-1"></i>
                                Perbarui Password</h4>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="{{ route('user.edit_password') }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="simpleinput" class="form-label">Password Lama</label>
                                    <input type="password" name="password_lama" placeholder="Password lama.."
                                        class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="simpleinput" class="form-label">Password Baru</label>
                                    <input type="password" name="password_baru" placeholder="Password baru.."
                                        class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="simpleinput" class="form-label">Konfirmasi Password Baru</label>
                                    <input type="password" name="password_confirm" placeholder="konfirmasi password.."
                                        class="form-control">
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">Perbarui</button>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>

    @endsection

    @section('js')
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="{{ asset('assets/libs/ckeditor_basic/ckeditor.js') }}"></script>
        <script src="{{ asset('assets/libs/cropter/ijaboCropTool.min.js') }}"></script>
        <script>
            $('#foto').ijaboCropTool({
                preview: '.image-previewer',
                setRatio: 1,
                allowedExtensions: ['jpg', 'jpeg', 'png'],
                buttonsText: ['upload', 'kembali'],
                buttonsColor: ['#3498db', '#e74c3c', -15],
                processUrl: '{{ route('upload_picture') }}',
                withCSRF: ['_token', '{{ csrf_token() }}'],
                onSuccess: function(message, element, status) {
                    window.location.reload(true)
                },
                onError: function(message, element, status) {
                    alert(message);
                }
            });
            CKEDITOR.replace('editor1');
        </script>
    @endsection
