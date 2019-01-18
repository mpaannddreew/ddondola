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
    <script>
        $(function () {

            // Product thumb images

            if ($('.proimage-thumb li a').length > 0) {
                var full_image = $(this).attr("href");
                $(".proimage-thumb li a").click(function () {
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

            $('.slider-for-gold').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
                slide: 'li',
                fade: false,
                asNavFor: '.slider-nav-gold'
            });

            $('.slider-nav-gold').slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                asNavFor: '.slider-for-gold',
                dots: false,
                arrows: true,
                slide: 'li',
                vertical: true,
                centerMode: true,
                centerPadding: '0',
                focusOnSelect: true,
                responsive: [
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1,
                            infinite: true,
                            vertical: false,
                            centerMode: true,
                            dots: false,
                            arrows: false
                        }
                    },
                    {
                        breakpoint: 641,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1,
                            infinite: true,
                            vertical: true,
                            centerMode: true,
                            dots: false,
                            arrows: false
                        }
                    },
                    {
                        breakpoint: 420,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1,
                            infinite: true,
                            vertical: false,
                            centerMode: true,
                            dots: false,
                            arrows: false
                        }
                    }
                ]
            });
        });

    </script>
@endsection

