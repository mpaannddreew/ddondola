@extends('layouts.base.ddondola')
@section('header-navbar-class', 'border-bottom')
@section('tabs')
    @include('layouts.sections.tabs')
@endsection
@section('javascripts')
    @parent
    <script type="text/javascript" src="{{ asset('website/typed.js') }}"></script>
    <script>
        $(function () {
            $(".main-search-container, .address-container").each(function () {
                var attrImageBG = $(this).attr('data-background-image');
                var attrColorBG = $(this).attr('data-background-color');
                if (attrImageBG !== undefined) {
                    $(this).css('background-image', 'url(' + attrImageBG + ')');
                }
                if (attrColorBG !== undefined) {
                    $(this).css('background', '' + attrColorBG + '');
                }
            });

            var typed = new Typed('.typed-words', {
                strings: [ "Discover new shopping experiences", "Discover new products","Discover new shops",
                    "Create your own shop", "Sell your own products", "Get paid directly into your bank account"],
                typeSpeed: 80,
                backSpeed: 80,
                backDelay: 4000,
                startDelay: 1000,
                loop: true,
                showCursor: true
            });

            $('.testimonial-carousel').slick({
                centerMode: true,
                centerPadding: '34%',
                slidesToShow: 1,
                dots: true,
                arrows: false,
                responsive: [{breakpoint: 1025, settings: {centerPadding: '10px', slidesToShow: 2,}}, {
                    breakpoint: 767,
                    settings: {centerPadding: '10px', slidesToShow: 1}
                }]
            });

            $('.simple-slick-carousel').slick({
                infinite: true,
                slidesToShow: 3,
                slidesToScroll: 3,
                dots: true,
                arrows: true,
                responsive: [{breakpoint: 992, settings: {slidesToShow: 2, slidesToScroll: 2}}, {
                    breakpoint: 769,
                    settings: {slidesToShow: 1, slidesToScroll: 1}
                }]
            });

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