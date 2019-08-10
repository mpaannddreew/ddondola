<div class="bg-white">
    @include('shoppie::shop.product.sections.carousel')
</div>
<div class="header-navbar collapse d-lg-flex p-0 bg-white border-top border-bottom sticky">
    <div class="container p-0">
        <div class="row">
            <div class="col-12 col-sm-6 text-center text-sm-left mb-4 mb-sm-0">
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                    <li class="nav-item">
                        <a href="{{ route('product', ['product' => $product]) }}" class="nav-link @yield('home-active')"><i class="material-icons">description</i> Details</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('product.reviews', ['product' => $product]) }}" class="nav-link @yield('reviews-active')"><i class="material-icons">rate_review</i> Reviews</a>
                    </li>

                </ul>
            </div>
            <div class="col-12 col-sm-6 d-flex align-items-center">
                <product-actions :product="{{ $product }}"></product-actions>
            </div>
        </div>
    </div>
</div>
<div class="container py-2">
    <div class="row">
        <div class="col-md-3 px-1">
            <rating-meter :reviewable="{{ $product }}"></rating-meter>
        </div>
        <div class="col-md-6 px-1">
            @yield('product')
        </div>
        <div class="col-md-3 px-1">
            <div class="card card-small border">
                <div class="card-body text-center">
                    <h5>{{ $product->shop()->name }}</h5>
                    <a href="{{ route('shop', ['shop' => $product->shop()]) }}" class="btn btn-pill btn-outline-primary">
                        <i class="fa fa-shopping-bag"></i> Seller
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>