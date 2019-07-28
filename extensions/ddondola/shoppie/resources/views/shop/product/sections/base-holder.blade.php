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