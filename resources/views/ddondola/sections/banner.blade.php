@section('banner')
<section class="image-bg lis-grediant grediant-bt-dark text-white py-4 profile-inner">
    <div class="background-image-maker"></div>
    <div class="holder-image"> <img src="{{ $user->coverPicture()['url'] }}" alt="" class="img-fluid d-none"> </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6 mb-4 mb-lg-0">
                <a href="javascript:void(0)" class="text-white">
                    <div class="media d-block d-md-flex text-md-left text-center">
                        <img style="width: 100px; height: 100px;" src="{{ $user->avatar()['url'] }}" class="img-fluid d-md-flex mr-4 border border-white lis-border-width-4 mb-4 mb-md-0 rounded" alt="" />

                        <div class="media-body align-self-center">
                            <h5 class="text-white lis-font-weight-500 lis-line-height-1">{{ $user->name }}</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-12 col-md-6 align-self-center">
                <ul class="list-unstyled mb-0 lis-line-height-2 text-md-right text-center">
                    @if($user->profile("phone_number"))
                    <li><i class="fa fa-phone pr-2"></i> {{ $user->profile("phone_number") }}</li>
                    @endif
                    <li>
                        <a href="javascript:void(0)" class="text-white"><i class="fa fa-envelope pr-2"></i> {{ $user->email }}</a>
                    </li>
                    @if($user->profile("address"))
                    <li>
                        <a href="javascript:void(0)" class="text-white"><i class="fa fa-map-o pr-2"></i> {{ $user->profile("address") }}</a>
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
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row @yield('user-nav-fill')">
                    @auth
                        @if(Auth::user()->is($user))
                            <li class="nav-item"><a href="{{ route('my.profile') }}" class="nav-link @yield('profile-active')"><i class="material-icons">view_day</i> Activity</a></li>
                            <li class="nav-item"><a href="{{ route('my.followers') }}" class="nav-link @yield('followers-active')"><i class="material-icons">people</i> Followers</a></li>
                            <li class="nav-item"><a href="{{ route('my.following') }}" class="nav-link @yield('following-active')"><i class="material-icons">people_outline</i> Following</a></li>
                        @else
                            <li class="nav-item"><a href="{{ route('user.profile', ['user' => $user]) }}" class="nav-link @yield('profile-active')"><i class="material-icons">view_day</i> Activity</a></li>
                            <li class="nav-item"><a href="{{ route('user.followers', ['user' => $user]) }}" class="nav-link @yield('followers-active')"><i class="material-icons">people</i> Followers</a></li>
                            <li class="nav-item"><a href="{{ route('user.following', ['user' => $user]) }}" class="nav-link @yield('following-active')"><i class="material-icons">people_outline</i> Following</a></li>
                        @endif
                    @else
                        <li class="nav-item"><a href="{{ route('user.profile', ['user' => $user]) }}" class="nav-link @yield('profile-active')"><i class="material-icons">view_day</i> Activity</a></li>
                        <li class="nav-item"><a href="{{ route('user.followers', ['user' => $user]) }}" class="nav-link @yield('followers-active')"><i class="material-icons">people</i> Followers</a></li>
                        <li class="nav-item"><a href="{{ route('user.following', ['user' => $user]) }}" class="nav-link @yield('following-active')"><i class="material-icons">people_outline</i> Following</a></li>
                    @endauth
                </ul>
            </div>
            <div class="col-12 col-sm-6 d-flex align-items-center">
                <div class="ml-auto">
                    @auth
                        @if(!Auth::user()->is($user))
                            <user-actions :user="{{ $user }}" my-messenger-url="{{ route("my.messenger") }}"></user-actions>
                        @else
                            @can('create', Shoppie\Shop::class)
                                <a href="{{ route('create.shop') }}" class="btn btn-sm btn-success ml-auto btn-pill">
                                    <i class="material-icons">add</i> New Shop
                                </a>
                            @endcan
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>