<li class="nav-item">
    <a href="{{ route('product', ['product' => $product]) }}" class="nav-link @yield('home-active')"><i class="material-icons">description</i> Details</a>
</li>
<li class="nav-item">
    <a href="{{ route('product.reviews', ['product' => $product]) }}" class="nav-link @yield('reviews-active')"><i class="material-icons">rate_review</i> Reviews</a>
</li>
