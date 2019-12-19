@section('banner')
<section class="image-bg lis-grediant grediant-bt-dark text-white py-4 profile-inner">
    <div class="background-image-maker"></div>
    <div class="holder-image"> <img src="{{ $shop->coverPicture()['url'] }}" alt="" class="img-fluid d-none"> </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6 mb-4 mb-lg-0">
                <a href="javascript:void(0)" class="text-white">
                    <div class="media d-block d-md-flex text-md-left text-center">
                        <img style="width: 100px; height: 100px;" src="{{ $shop->avatar()['url'] }}" class="img-fluid d-md-flex mr-4 border border-white lis-border-width-4 mb-4 mb-md-0 rounded" alt="" />

                        <div class="media-body align-self-center">
                            <h5 class="text-white lis-font-weight-500 lis-line-height-1 mb-2">{{ $shop->name }}</h5>
                            {{--<p class="mb-0">{{ $shop->likeCount() }} {{ $shop->likeCount() > 1 || $shop->likeCount() == 0 ? "likes": "like"  }}</p>--}}
                            <p class="mb-0"><mini-rating-meter :reviewable="{{ $shop }}" :show-base="false"></mini-rating-meter></p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-12 col-md-6 align-self-center">
                <ul class="list-unstyled mb-0 lis-line-height-2 text-md-right text-center">
                    <li><i class="fa fa-phone pr-2"></i> {{ $shop->profile("phone_number") }}</li>
                    <li>
                        <a href="javascript:void(0)" class="text-white"><i class="fa fa-envelope pr-2"></i> {{ $shop->profile("email") }}</a>
                    </li>
                    @if($shop->profile("address"))
                    <li>
                        <a href="javascript:void(0)" class="text-white"><i class="fa fa-map-o pr-2"></i> {{ $shop->profile("address") }}</a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</section>
    @show
<div class="header-navbar collapse d-lg-flex p-0 bg-white border-bottom sticky">
    <div class="container p-0">
        <div class="row">
            <div class="col-12 col-sm-6 text-center text-sm-left mb-4 mb-sm-0">
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row @yield('shop-nav-fill')">
                    <li class="nav-item">
                        <a title="Shop" href="{{ route('shop', ['shop' => $shop]) }}" class="nav-link @yield('products-active')">
                            <i class="material-icons">shop_two</i> Shop
                        </a>
                    </li>
                    <li class="nav-item">
                        <a title="Reviews" href="{{ route('shop.reviews', ['shop' => $shop]) }}" class="nav-link @yield('reviews-active')">
                            <i class="material-icons">rate_review</i> Reviews
                        </a>
                    </li>
                    @auth
                        @if(auth()->user()->manages($shop))
                        <li class="nav-item">
                            <a href="{{ route('my.shop.edit', ['shop' => $shop]) }}" class="nav-link @yield('info-active')">
                                <i class="material-icons">mode_edit</i>
                                <span>Edit Info</span>
                            </a>
                        </li>
                        @endif
                    @endauth
                </ul>
            </div>
            <div class="col-12 col-sm-6 d-flex align-items-center">
                @auth
                <shop-actions :shop="{{ $shop }}" my-messenger-url="{{ route('my.messenger') }}"></shop-actions>
                @endauth
            </div>
        </div>
    </div>
</div>