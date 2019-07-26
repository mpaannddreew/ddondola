@section('footer')
<footer class="border-top">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="widget">
                    <div class="foot-logo">
                        <div class="logo">
                            <a href="index.html" title=""><img src="images/logo.png" alt=""></a>
                        </div>
                        <p>
                            Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt consectetur, adipisci velit.
                        </p>
                    </div>
                    <ul class="location">
                        <li>
                            <i class="fa fa-map"></i>
                            <p>33 new montgomery st.750 san francisco, CA USA 94105.</p>
                        </li>
                        <li>
                            <i class="fa fa-mobile"></i>
                            <p>+1-56-346 345</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-md-4">
                <div class="widget">
                    <div class="widget-title"><h4>follow</h4></div>
                    <ul class="list-style">
                        <li><i class="fa fa-facebook-square"></i><a href="javascript:void(0)" title="Facebook">Facebook</a></li>
                        <li><i class="fa fa-twitter-square"></i><a href="javascript:void(0)" title="Twitter">Twitter</a></li>
                        <li><i class="fa fa-instagram"></i><a href="javascript:void(0)" title="Instagram">Instagram</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-md-4">
                <div class="widget">
                    <div class="widget-title"><h4>Navigate</h4></div>
                    <ul class="list-style">
                        @guest
                            <li><a href="{{ route('login') }}" title="Products">Login</a></li>
                            <li><a href="{{ route('register') }}" title="Products">Register</a></li>
                        @endguest
                        <li><a href="{{ route('products') }}" title="Products">Products</a></li>
                        <li><a href="{{ route('shops') }}" title="Shops">Shops</a></li>
                        <li><a href="{{ route('users.index') }}" title="People">People</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-md-4">
                <div class="widget">
                    <div class="widget-title"><h4>useful links</h4></div>
                    <ul class="list-style">
                        <li><a href="{{ route('contact') }}" title="Contact Us">Contact Us</a></li>
                        <li><a href="{{ route('policy') }}" title="Privacy Policy">Privacy Policy</a></li>
                        <li><a href="{{ route('terms') }}" title="Terms &amp; Conditions">Terms &amp; Conditions</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<div class="bottombar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <span class="copyright">&copy; {{ config('app.name', 'Ddondola') }} 2019. All rights reserved.</span>
                <i><img src="images/credit-cards.png" alt=""></i>
            </div>
        </div>
    </div>
</div>
@show