@extends('base')
@section('title')@parent Contact Us @endsection
@section('stylesheets')
    @parent
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}" />
@endsection
@section('body-class') class="h-100 bg-white" @endsection
@section('contact-active', 'active')
@section('main')
    <!-- Map Container -->
    <div class="contact-map mb-5">

        <!-- Google Maps -->
        <div id="singleListingMap-container">
            <div id="singleListingMap" data-latitude="40.70437865245596" data-longitude="-73.98674011230469" data-map-icon="im im-icon-Map2"></div>
            <a href="#" id="streetView">Street View</a>
        </div>
        <!-- Google Maps / End -->

        <!-- Office -->
        <div class="address-box-container">
            <div class="address-container" data-background-image="{{ asset('images/our-office.jpg') }}">
                <div class="office-address">
                    <h3>Our Office</h3>
                    <ul>
                        <li>John Street 304</li>
                        <li>New York</li>
                        <li>Phone (123) 123-456 </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Office / End -->

    </div>
    <div class="clearfix"></div>
    <!-- Map Container / End -->
    <!-- Container / Start -->
    <div class="container mb-5">

        <div class="row">

            <!-- Contact Details -->
            <div class="col-md-4">

                <h4 class="headline mb-4">Find Us There</h4>

                <!-- Contact Details -->
                <div class="sidebar-textbox">
                    <p>Collaboratively administrate channels whereas virtual. Objectively seize scalable metrics whereas proactive e-services.</p>

                    <ul class="contact-details">
                        <li><i class="fa fa-phone"></i><strong>Phone:</strong> <span>(123) 123-456 </span></li>
                        <li><i class="fa fa-envelope-o"></i><strong>E-Mail:</strong> <span><a href="#">office@example.com</a></span></li>
                    </ul>
                </div>

            </div>

            <!-- Contact Form -->
            <div class="col-md-8">

                <section id="contact">
                    <h4 class="headline mb-4">Contact Form</h4>

                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control form-control-lg" id="name" placeholder="Name">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="email" class="form-control form-control-lg" id="email" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-lg" id="subject" placeholder="Subject">
                        </div>
                        <div class="form-group">
                            <textarea rows="5" type="text" class="form-control form-control-lg" id="message" placeholder="Message"></textarea>
                        </div>
                        <button type="submit" class="btn btn-lg btn-pill btn-outline-primary">Send Message</button>
                    </form>
                </section>
            </div>
            <!-- Contact Form / End -->

        </div>

    </div>
    <!-- Container / End -->
@endsection

