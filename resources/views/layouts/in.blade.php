@extends('layouts.app')
@section('stylesheets')
    <link rel="stylesheet" href="{{ asset('css/material-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/theme.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/extras.1.2.0.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('slick/slick.css') }}"/>
    <link rel="stylesheet" href="{{ asset('slick/slick-theme.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/changes.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/shoppie.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/messenger.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}"/>
    <script async defer src="{{ asset('js/buttons.js') }}"></script>
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
    <script src="{{ asset('js/theme.min.js') }}"></script>
    <script src="{{ asset('js/libs/Sharrre/2.0.1/jquery.sharrre.min.js') }}"></script>
    <script src="{{ asset('js/extras.min.js') }}"></script>
    <script src="{{ asset('js/theme-extra.min.js') }}"></script>
    <script src="{{ asset('slick/slick.min.js') }}"></script>
    <script src="{{ asset('js/typeahead.bundle.js') }}"></script>
    <script src="{{ asset('js/handlebars.min.js') }}"></script>
    <script>
        $(function () {
            $(".input-daterange").datepicker({});
            $('.background-image-maker').each(function () {
                var imgURL = $(this).next('.holder-image').find('img').attr('src');
                $(this).css('background-image', 'url(' + imgURL + ')');
            });
        });
    </script>
@endsection

