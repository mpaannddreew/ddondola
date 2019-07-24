@extends('base')
@section('title')@parent Welcome @endsection
@section('stylesheets')
    @parent
    <link rel="stylesheet" href="{{ asset('website/welcome.css') }}" />
@endsection
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
                        Popular Products
                        <span>Browse the most desirable products</span>
                    </h3>
                </div>

            </div>
        </div>


        <!-- Categories Carousel -->
        <div class="fullwidth-carousel-container margin-top-25">
            <div class="fullwidth-slick-carousel category-carousel">

                <!-- Item -->
                <div class="fw-carousel-item">
                    <div class="category-box-container">
                        <a href="javascript:void(0)" class="category-box" data-background-image="{{ asset('images/product/9.jpg') }}">
                            <div class="category-box-content">
                                <h3>Hotels</h3>
                                <span>64 listings</span>
                            </div>
                            <span class="category-box-btn">Browse</span>
                        </a>
                    </div>
                </div>

                <!-- Item -->
                <div class="fw-carousel-item">
                    <div class="category-box-container">
                        <a href="javascript:void(0)" class="category-box" data-background-image="{{ asset('images/product/9.jpg') }}">
                            <div class="category-box-content">
                                <h3>Events</h3>
                                <span>67 listings</span>
                            </div>
                            <span class="category-box-btn">Browse</span>
                        </a>
                    </div>
                </div>

                <!-- Item -->
                <div class="fw-carousel-item">
                    <div class="category-box-container">
                        <a href="javascript:void(0)" class="category-box" data-background-image="{{ asset('images/product/9.jpg') }}">
                            <div class="category-box-content">
                                <h3>Fitness</h3>
                                <span>27 listings</span>
                            </div>
                            <span class="category-box-btn">Browse</span>
                        </a>
                    </div>
                </div>

                <!-- Item -->
                <div class="fw-carousel-item">
                    <div class="category-box-container">
                        <a href="javascript:void(0)" class="category-box" data-background-image="{{ asset('images/product/9.jpg') }}">
                            <div class="category-box-content">
                                <h3>Nightlife</h3>
                                <span>22 listings</span>
                            </div>
                            <span class="category-box-btn">Browse</span>
                        </a>
                    </div>
                </div>

                <!-- Item -->
                <div class="fw-carousel-item">
                    <div class="category-box-container">
                        <a href="javascript:void(0)" class="category-box" data-background-image="{{ asset('images/product/9.jpg') }}">
                            <div class="category-box-content">
                                <h3>Eat & Drink</h3>
                                <span>130 listings</span>
                            </div>
                            <span class="category-box-btn">Browse</span>
                        </a>
                    </div>
                </div>

            </div>
        </div>
        <!-- Categories Carousel / End -->

    </section>
    <section class="featured-lis section-padding border-top">
        <div class="container">
            <div class="row">

                <div class="col-md-12">
                    <h3 class="headline centered margin-bottom-45">
                        Most Visited Shops
                        <span>Discover & connect with top-rated local businesses</span>
                    </h3>
                </div>

                <div class="col-md-12">
                    <div class="simple-slick-carousel dots-nav">

                        <!-- Listing Item -->
                        <div class="carousel-item">
                            <a href="javascript:void(0)" class="listing-item-container">
                                <div class="listing-item">
                                    <img src="{{ asset('images/product/9.jpg') }}" alt="">

                                    <div class="listing-badge now-open">Now Open</div>

                                    <div class="listing-item-content">
                                        <span class="tag">Eat & Drink</span>
                                        <h3>Tom's Restaurant <i class="verified-icon"></i></h3>
                                        <span>964 School Street, New York</span>
                                    </div>
                                    <span class="like-icon"></span>
                                </div>
                                <div class="star-rating" data-rating="3.5">
                                    <div class="rating-counter">(12 reviews)</div>
                                </div>
                            </a>
                        </div>
                        <!-- Listing Item / End -->

                        <!-- Listing Item -->
                        <div class="carousel-item">
                            <a href="javascript:void(0)" class="listing-item-container">
                                <div class="listing-item">
                                    <img src="{{ asset('images/product/9.jpg') }}" alt="">
                                    <div class="listing-item-details">
                                        <ul>
                                            <li>Friday, August 10</li>
                                        </ul>
                                    </div>
                                    <div class="listing-item-content">
                                        <span class="tag">Events</span>
                                        <h3>Sticky Band</h3>
                                        <span>Bishop Avenue, New York</span>
                                    </div>
                                    <span class="like-icon"></span>
                                </div>
                                <div class="star-rating" data-rating="5.0">
                                    <div class="rating-counter">(23 reviews)</div>
                                </div>
                            </a>
                        </div>
                        <!-- Listing Item / End -->

                        <!-- Listing Item -->
                        <div class="carousel-item">
                            <a href="javascript:void(0)" class="listing-item-container">
                                <div class="listing-item">
                                    <img src="{{ asset('images/product/9.jpg') }}" alt="">
                                    <div class="listing-item-details">
                                        <ul>
                                            <li>Starting from $59 per night</li>
                                        </ul>
                                    </div>
                                    <div class="listing-item-content">
                                        <span class="tag">Hotels</span>
                                        <h3>Hotel Govendor</h3>
                                        <span>778 Country Street, New York</span>
                                    </div>
                                    <span class="like-icon"></span>
                                </div>
                                <div class="star-rating" data-rating="2.0">
                                    <div class="rating-counter">(17 reviews)</div>
                                </div>
                            </a>
                        </div>
                        <!-- Listing Item / End -->

                        <!-- Listing Item -->
                        <div class="carousel-item">
                            <a href="javascript:void(0)" class="listing-item-container">
                                <div class="listing-item">
                                    <img src="{{ asset('images/product/9.jpg') }}" alt="">

                                    <div class="listing-badge now-open">Now Open</div>

                                    <div class="listing-item-content">
                                        <span class="tag">Eat & Drink</span>
                                        <h3>Burger House <i class="verified-icon"></i></h3>
                                        <span>2726 Shinn Street, New York</span>
                                    </div>
                                    <span class="like-icon"></span>
                                </div>
                                <div class="star-rating" data-rating="5.0">
                                    <div class="rating-counter">(31 reviews)</div>
                                </div>
                            </a>
                        </div>
                        <!-- Listing Item / End -->

                        <!-- Listing Item -->
                        <div class="carousel-item">
                            <a href="javascript:void(0)" class="listing-item-container">
                                <div class="listing-item">
                                    <img src="{{ asset('images/product/9.jpg') }}" alt="">
                                    <div class="listing-item-content">
                                        <span class="tag">Other</span>
                                        <h3>Airport</h3>
                                        <span>1512 Duncan Avenue, New York</span>
                                    </div>
                                    <span class="like-icon"></span>
                                </div>
                                <div class="star-rating" data-rating="3.5">
                                    <div class="rating-counter">(46 reviews)</div>
                                </div>
                            </a>
                        </div>
                        <!-- Listing Item / End -->

                        <!-- Listing Item -->
                        <div class="carousel-item">
                            <a href="javascript:void(0)" class="listing-item-container">
                                <div class="listing-item">
                                    <img src="{{ asset('images/product/9.jpg') }}" alt="">

                                    <div class="listing-badge now-closed">Now Closed</div>

                                    <div class="listing-item-content">
                                        <span class="tag">Eat & Drink</span>
                                        <h3>Think Coffee</h3>
                                        <span>215 Terry Lane, New York</span>
                                    </div>
                                    <span class="like-icon"></span>
                                </div>
                                <div class="star-rating" data-rating="4.5">
                                    <div class="rating-counter">(15 reviews)</div>
                                </div>
                            </a>
                        </div>
                        <!-- Listing Item / End -->
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
                        What Our Users Say
                        <span class="margin-top-25">We collect reviews from our users so you can get an honest opinion of what an experience with our website are really like!</span>
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
                    Get Associated With Us
                    <span>Expolore top-rated shops, activities and more</span>
                </h3>
            </div>
            <div class="row">
                <div class="col-12 col-md-4 text-center mb-5 mb-md-0">
                    <div class="lis-features-box lis-brd-light border rounded px-4 py-5 bg-white">
                        <div  class="h1"><i class="fa fa-address-card-o h1"></i></div>
                        <h5>Add Your Listing</h5>
                        Maecs tempus, tellus eget rhoncus, sem condimentum quam semper libero.
                    </div>
                </div>
                <div class="col-12 col-md-4 text-center mb-5 mb-md-0">
                    <div class="lis-features-box lis-brd-light border rounded px-4 py-5 bg-white">
                        <div  class="h1"><i class="fa fa-bullhorn h1"></i></div>
                        <h5>Advertise & Promote</h5>
                        Maecs tempus, tellus eget rhoncus, sem condimentum quam semper libero.
                    </div>
                </div>
                <div class="col-12 col-md-4 text-center">
                    <div class="lis-features-box lis-brd-light border rounded px-4 py-5 bg-white">
                        <div  class="h1"><i class="fa fa-handshake-o h1"></i></div>
                        <h5>Partner With Us</h5>
                        Maecs tempus, tellus eget rhoncus, sem condimentum quam semper libero.
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection