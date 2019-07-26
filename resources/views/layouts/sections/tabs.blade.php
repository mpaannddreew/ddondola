<li class="nav-item">
    <a href="{{ route('welcome') }}" class="nav-link @yield('home-active')"><i class="material-icons">home</i></a>
</li>
<li class="nav-item">
    <a href="{{ route('products') }}" class="nav-link @yield('products-active')"><i class="material-icons">local_mall</i> Products</a>
</li>
<li class="nav-item">
    <a href="{{ route('shops') }}" class="nav-link @yield('shops-active')"><i class="material-icons">shop_two</i> Shops</a>
</li>
<li class="nav-item">
    <a href="{{ route('contact') }}" class="nav-link @yield('contact-active')"><i class="material-icons">map</i> Contact Us</a>
</li>
<li class="nav-item">
    <a href="{{ route('policy') }}" class="nav-link @yield('policy-active')"><i class="material-icons">info</i> Privacy Policy</a>
</li>
<li class="nav-item">
    <a href="{{ route('terms') }}" class="nav-link @yield('terms-active')"><i class="material-icons">info_outline</i>Terms &amp; Conditions</a>
</li>