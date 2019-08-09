@extends('layouts.app')
@section('stylesheets')
    <link rel="stylesheet" href="{{ asset('css/filepond.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/filepond-plugin-image-preview.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/filepond-plugin-image-edit.css') }}"/>
    <link rel="stylesheet" href="{{ asset('slick/slick.css') }}"/>
    <link rel="stylesheet" href="{{ asset('slick/slick-theme.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/ui.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/changes.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/shoppie.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/messenger.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}"/>
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
    <script src="{{ asset('slick/slick.min.js') }}"></script>
    <script src="{{ asset('js/typeahead.bundle.js') }}"></script>
    <script src="{{ asset('js/handlebars.min.js') }}"></script>
    <script src="{{ asset('js/jquery.sticky.js') }}"></script>
    <script>
        $(function () {
            $(".input-daterange").datepicker({}).val();
            $('.background-image-maker').each(function () {
                var imgURL = $(this).next('.holder-image').find('img').attr('src');
                $(this).css('background-image', 'url(' + imgURL + ')');
            });

            $(".sticky").sticky({topSpacing: 60, zIndex: 1015});
        });
    </script>
@endsection

