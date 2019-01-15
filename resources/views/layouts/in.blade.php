@extends('layouts.app')
@section('stylesheets')
    <link rel="stylesheet" href="{{ asset('css/material-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/shards-dashboards.1.2.0.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/extras.1.2.0.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/changes.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/shoppie.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/messenger.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}"/>
    <script async defer src="{{ asset('js/buttons.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('light-gallery/css/lightgallery.min.css') }}"/>
@endsection

@section('body-class') class="h-100" @endsection
@section('app')
    <div class="@section('container-fluid-class') container-fluid @show" id="app">
        <div class="row">
            @yield('container-fluid')
        </div>
    </div>
@endsection

@section('javascripts')
    <script src="{{ asset('js/libs/popper.js/1.14.3/umd/popper.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/libs/Chart.js/2.7.1/Chart.min.js') }}"></script>
    <script src="{{ asset('js/shards.min.js') }}"></script>
    <script src="{{ asset('js/libs/Sharrre/2.0.1/jquery.sharrre.min.js') }}"></script>
    <script src="{{ asset('js/extras.1.2.0.min.js') }}"></script>
    <script src="{{ asset('js/shards-dashboards.1.2.0.min.js') }}"></script>
    <script src="{{ asset('light-gallery/js/lightgallery-all.min.js') }}"></script>
    <script>
        $(function () {

            // Product thumb images

            if ($('.proimage-thumb li a').length > 0) {
                var full_image = $(this).attr("href");
                $(".proimage-thumb li a").click(function() {
                    full_image = $(this).attr("href");
                    $(".pro-image img").attr("src", full_image);
                    return false;
                });
            }

            // Lightgallery

            if ($('#pro_popup').length > 0) {
                $('#pro_popup').lightGallery({
                    thumbnail: true,
                    selector: 'a'
                });
            }

            if ($('#lightgallery').length > 0) {
                $('#lightgallery').lightGallery({
                    thumbnail: true,
                    selector: 'a'
                });
            }
        });

    </script>
@endsection

