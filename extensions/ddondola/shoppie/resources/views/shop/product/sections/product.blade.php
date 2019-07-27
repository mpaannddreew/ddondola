<div class="bg-white">
    <div class="container">
        <div class="card">
            <div class="row no-gutters">
                <aside class="col-sm-5 border-right py-2">
                    <article class="gallery-wrap">
                        <div class="img-big-wrap">
                            <div> <a href="{{ asset('images/product/9.jpg') }}" data-fancybox=""><img src="{{ asset('images/product/9.jpg') }}"></a></div>
                        </div> <!-- slider-product.// -->
                        <div class="img-small-wrap">
                            <div class="item-gallery"> <img src="{{ asset('images/product/9.jpg') }}"></div>
                            <div class="item-gallery"> <img src="{{ asset('images/product/9.jpg') }}"></div>
                            <div class="item-gallery"> <img src="{{ asset('images/product/9.jpg') }}"></div>
                            <div class="item-gallery"> <img src="{{ asset('images/product/9.jpg') }}"></div>
                        </div> <!-- slider-nav.// -->
                    </article> <!-- gallery-wrap .end// -->
                </aside>
                <aside class="col-sm-7">
                    <article class="p-5">
                        <h3 class="title mb-3">{{ $product->name }}</h3>
                        <div class="mb-3">
                            <var class="price h3 text-warning">
                                <span class="currency">{{ $product->currencyCode() }}</span> <span class="num">{{ $product->discountedPrice() }}</span>
                                @if($product->discount())
                                    <span style="text-decoration: line-through">
                                <span class="currency text-muted">{{ $product->currencyCode() }}</span> <span class="num text-muted">{{ $product->price }}</span>
                            </span>
                                @endif
                            </var>
                        </div> <!-- price-detail-wrap .// -->
                        <dl>
                            <dt>Description</dt>
                            <dd>
                                <p>
                                    {{ $product->description }}
                                </p>
                            </dd>
                        </dl>
                        <dl class="row">
                            <dt class="col-sm-3">Brand</dt>
                            <dd class="col-sm-9">{{ $product->brand->name }}</dd>

                            <dt class="col-sm-3">Category</dt>
                            <dd class="col-sm-9">{{ $product->category()->name }}</dd>

                            <dt class="col-sm-3">Subcategory</dt>
                            <dd class="col-sm-9">{{ $product->subcategory->name }}</dd>
                        </dl>
                        <div class="rating-wrap mb-4">
                            <mini-rating-meter :reviewable="{{ $product }}"></mini-rating-meter>
                        </div> <!-- rating-wrap.// -->
                        {{--<rating-meter :reviewable="{{ $product }}"></rating-meter>--}}
                        <product-actions :product="{{ $product }}"></product-actions>
                    </article> <!-- card-body.// -->
                </aside> <!-- col.// -->
            </div> <!-- row.// -->
        </div>
    </div>
</div>