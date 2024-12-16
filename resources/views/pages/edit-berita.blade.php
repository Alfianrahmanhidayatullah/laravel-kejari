@extends('layouts.app')

@section('title', 'Edit Berita')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('library/codemirror/lib/codemirror.css') }}">
    <link rel="stylesheet" href="{{ asset('library/codemirror/theme/duotone-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Berita</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Berita</a></div>
                    <div class="breadcrumb-item">Edit Berita</div>
                </div>
            </div>

            <div class="section-body">


                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Form Edit Berita</h4>
                            </div>
                            <form class="form" action="/admin/berita/{{ Request::segment(3) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Judul
                                            Berita</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" class="form-control" name="judul"
                                                value="{{ $berita->judul }}">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Deskripsi
                                            Berita</label>
                                        <div class="col-sm-12 col-md-7">
                                            <textarea type="text" class="form-control" name="deskripsi"> {{ $berita->deskripsi }} </textarea>

                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Gambar
                                            Berita</label>
                                        <div id="image-preview" class="image-preview"
                                            style="background-image: url('{{ asset('img/berita/' . $berita->gambar) }}') ; background-size: cover;
                                            background-position: center center;">
                                            <label for="image-upload" id="image-label">Choose File</label>
                                            <input type="file" name="gambar" id="image-upload"
                                                value="{{ $berita->gambar }}" />
                                        </div>
                                    </div>



                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                        <div class="col-sm-12 col-md-7">
                                            <button class="btn btn-primary" type="submit">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/summernote/dist/summernote-bs4.js') }}"></script>
    <script src="{{ asset('library/codemirror/lib/codemirror.js') }}"></script>
    <script src="{{ asset('library/codemirror/mode/javascript/javascript.js') }}"></script>
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('library/upload-preview/upload-preview.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/features-post-create.js') }}"></script>

    <!-- Page Specific JS File -->
@endpush
