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
    <link rel="stylesheet" href="{{ asset('website/welcome.css') }}" />
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

            $('.fullwidth-slick-carousel').slick({
                centerMode: true,
                centerPadding: '20%',
                slidesToShow: 3,
                dots: true,
                arrows: false,
                responsive: [{breakpoint: 1920, settings: {centerPadding: '15%', slidesToShow: 3}}, {
                    breakpoint: 1441,
                    settings: {centerPadding: '10%', slidesToShow: 3}
                }, {breakpoint: 1025, settings: {centerPadding: '10px', slidesToShow: 2,}}, {
                    breakpoint: 767,
                    settings: {centerPadding: '10px', slidesToShow: 1}
                }]
            });
            $(window).on('load resize', function (e) {
                var carouselListItems = $(".fullwidth-slick-carousel .fw-carousel-item").length;
                if (carouselListItems < 4) {
                    $('.fullwidth-slick-carousel .slick-slide').css({'pointer-events': 'all', 'opacity': '1',});
                }
            });

            $('.category-box').each(function () {
                $(this).append('<div class="category-box-background"></div>');
                $(this).children('.category-box-background').css({'background-image': 'url(' + $(this).attr('data-background-image') + ')'});
            });
        });
    </script>
@endsection

