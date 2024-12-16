@extends('layouts.app')

@section('title', 'General Dashboard')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/fullcalendar/dist/fullcalendar.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <div class="d-flex flex-column">
                    <h1>Dashboard</h1>

                </div>
            </div>



            <div class="row">


                <div class="col-12">
                    <div class="section-header flex-column align-items-start ">
                        <div class="d-flex justify-content-center align-items-center w-100">
                            <h1>Halo Admin Kejari</h1>
                        </div>
                        <div class="d-flex justify-content-center align-items-center w-100 mt-5">


                        </div>
                    </div>
                </div>

            </div>


        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/simpleweather/jquery.simpleWeather.min.js') }}"></script>
    <script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('library/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
    <!-- JS Libraies -->
    <script src="{{ asset('library/fullcalendar/dist/fullcalendar.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/modules-calendar.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/index-0.js') }}"></script>
@endpush
