@section('banner')
    <section class="image-bg lis-grediant grediant-bt-dark text-white pb-4 profile-inner">
        <div class="background-image-maker"></div>
        <div class="holder-image">
            <img src="{{ $user->coverPicture() }}" alt="" class="img-fluid d-none">
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-12 mb-4 mb-lg-0">
                    <a href="javascript:void(0)" class="text-white">
                        <div class="media d-block d-sm-flex text-sm-left text-center">
                            <img style="width: 100px; height: 100px;" src="{{ $user->avatar() }}" class="img-fluid d-sm-flex mr-0 mr-sm-4 border border-white lis-border-width-4 mb-4 mb-md-0" alt="" />
                            <div class="media-body align-self-center">
                                <h5 class="text-white lis-font-weight-500 lis-line-height-1">{{ $user->name() }}</h5>
                                <p class="mb-0">{{ $user->viewFollower() }}</p>
                            </div>
                        </div>
                    </a>
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
                    @if(Auth::user()->is($user))
                        <li class="nav-item"><a href="{{ route('my.profile') }}" class="nav-link @yield('profile-active')"><i class="material-icons">account_circle</i> Profile</a></li>
                        <li class="nav-item"><a href="{{ route('my.followers') }}" class="nav-link @yield('followers-active')"><i class="material-icons">people</i> Followers</a></li>
                        <li class="nav-item"><a href="{{ route('my.following') }}" class="nav-link @yield('following-active')"><i class="material-icons">people_outline</i> Following</a></li>
                        <li class="nav-item"><a href="{{ route('my.settings') }}" class="nav-link @yield('settings-active')"><i class="material-icons">settings</i> Settings</a></li>
                    @else
                        <li class="nav-item"><a href="{{ route('user.profile', ['user' => $user->code]) }}" class="nav-link @yield('profile-active')"><i class="material-icons">account_circle</i> Profile</a></li>
                        <li class="nav-item"><a href="{{ route('user.followers', ['user' => $user->code]) }}" class="nav-link @yield('followers-active')"><i class="material-icons">people</i> Followers</a></li>
                        <li class="nav-item"><a href="{{ route('user.following', ['user' => $user->code]) }}" class="nav-link @yield('following-active')"><i class="material-icons">people_outline</i> Following</a></li>
                    @endif

                </ul>
            </div>
            <div class="col-12 col-sm-6 d-flex align-items-center">
                @if(!Auth::user()->is($user))
                <user-actions :user="{{ $user }}" my-messenger-url="{{ route("my.messenger") }}"></user-actions>
                @endif
            </div>
        </div>
    </div>
</div>