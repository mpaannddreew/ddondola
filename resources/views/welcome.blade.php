@extends('base')
@section('title')@parent Welcome @endsection
@section('custom-design')
    <!-- Banner
    ================================================== -->
    <div class="main-search-container centered" data-background-image="{{ asset('images/bg/main-home-background.jpg') }}">
        <div class="main-search-inner">

            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>
                            <!-- Typed words can be configured in script settings at the bottom of this HTML file -->
                            <span class="typed-words"></span>
                        </h2>
                        <h4>Discover top rated products, shops and new shopping experiences</h4>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('tabs', '')
@section('container', '')
@section('body-class') class="h-100 bg-white" @endsection
@section('home-active', 'active')
@section('main')
    <section class="works section-padding">
        <!-- Content
        ================================================== -->
        <div class="container">
            <div class="row">

                <div class="col-md-12">
                    <h3 class="headline centered margin-top-75">
                        <strong class="headline-with-separator">Featured Products</strong>
                        <span>Browse the most desirable products</span>
                    </h3>
                </div>

            </div>
        </div>


        <!-- Categories Carousel -->
        <div class="fullwidth-carousel-container margin-top-25">
            <div class="fullwidth-slick-carousel category-carousel">
                @foreach($products as $product)
                    <!-- Item -->
                    <fw-carousel-item :product="{{ $product }}"></fw-carousel-item>
                    <!-- Item / End -->
                @endforeach
            </div>
        </div>
        <!-- Categories Carousel / End -->

    </section>
    <section class="featured-lis section-padding border-top">
        <div class="container">
            <div class="row">

                <div class="col-md-12">
                    <h3 class="headline centered margin-bottom-45">
                        <strong class="headline-with-separator">Featured Shops</strong>
                        <span>Discover & connect with top-rated local businesses</span>
                    </h3>
                </div>

                <div class="col-md-12">
                    <div class="simple-slick-carousel dots-nav">

                    @foreach($shops as $shop)
                        <!-- Listing Item -->
                        <carousel-item :shop="{{ $shop }}"></carousel-item>
                        <!-- Listing Item / End -->
                    @endforeach
                    </div>

                </div>

            </div>
        </div>
    </section>
    <section class="works section-padding border-top">
        <!-- Info Section -->
        <div class="container">

            <div class="row">
                <div class="col-md-12">
                    <h3 class="headline centered headline-extra-spacing" align="center">
                        <strong class="headline-with-separator">What Our Users Say</strong>
                        <span class="margin-top-25">We collect reviews from our users so you can get an honest opinion of what an experience with our service is really like!</span>
                    </h3>
                </div>
            </div>

        </div>
        <!-- Info Section / End -->

        <!-- Categories Carousel -->
        <div class="fullwidth-carousel-container margin-top-20 no-dots">
            <div class="testimonial-carousel testimonials">

                <!-- Item -->
                <div class="fw-carousel-review">
                    <div class="testimonial-box">
                        <div class="testimonial">Bring to the table win-win survival strategies to ensure proactive domination. At the end of the day, going forward, a new normal that has evolved from generation is on the runway heading towards a streamlined cloud solution user generated content.</div>
                    </div>
                    <div class="testimonial-author">
                        <img src="{{ asset('images/testimonial/happy-client-01.jpg') }}" alt="">
                        <h4>Jennie Smith <span>Coffee Shop Owner</span></h4>
                    </div>
                </div>

                <!-- Item -->
                <div class="fw-carousel-review">
                    <div class="testimonial-box">
                        <div class="testimonial">Capitalize on low hanging fruit to identify a ballpark value added activity to beta test. Override the digital divide with additional clickthroughs from DevOps. Nanotechnology immersion along the information highway will close the loop.</div>
                    </div>
                    <div class="testimonial-author">
                        <img src="{{ asset('images/testimonial/happy-client-02.jpg') }}" alt="">
                        <h4>Tom Baker <span>Clothing Store Owner</span></h4>
                    </div>
                </div>

                <!-- Item -->
                <div class="fw-carousel-review">
                    <div class="testimonial-box">
                        <div class="testimonial">Leverage agile frameworks to provide a robust synopsis for high level overviews. Iterative approaches to corporate strategy foster collaborative thinking to further the overall value proposition. Organically grow the holistic world view.</div>
                    </div>
                    <div class="testimonial-author">
                        <img src="{{ asset('images/testimonial/happy-client-03.jpg') }}" alt="">
                        <h4>Jack Paden <span>Restaurant Owner</span></h4>
                    </div>
                </div>

            </div>
        </div>
        <!-- Categories Carousel / End -->
    </section>
    <section class="featured-lis section-padding border-top">
        <div class="container">
            <div class="col-md-12">
                <h3 class="headline centered margin-bottom-45">
                    <strong class="headline-with-separator">Get Associated With Us</strong>
                    <span>Create your own shop and start selling online from the comfort of your living room</span>
                </h3>
            </div>
            <div class="row">
                <div class="col-12 col-md-4 text-center mb-5 mb-md-0">
                    <div class="lis-features-box lis-brd-light border rounded px-4 py-5 bg-white">
                        <div  class="h1"><i class="fa fa-address-card-o h1"></i></div>
                        <h5>Create Your Shop</h5>
                        Maecs tempus, tellus eget rhoncus, sem condimentum quam semper libero.
                    </div>
                </div>
                <div class="col-12 col-md-4 text-center mb-5 mb-md-0">
                    <div class="lis-features-box lis-brd-light border rounded px-4 py-5 bg-white">
                        <div  class="h1"><i class="fa fa-bullhorn h1"></i></div>
                        <h5>Advertise &amp; Promote</h5>
                        Maecs tempus, tellus eget rhoncus, sem condimentum quam semper libero.
                    </div>
                </div>
                <div class="col-12 col-md-4 text-center">
                    <div class="lis-features-box lis-brd-light border rounded px-4 py-5 bg-white">
                        <div  class="h1"><i class="fa fa-handshake-o h1"></i></div>
                        <h5>Close Deals</h5>
                        Maecs tempus, tellus eget rhoncus, sem condimentum quam semper libero.
                    </div>
                </div>
            </div>
        </div>
    </section>
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