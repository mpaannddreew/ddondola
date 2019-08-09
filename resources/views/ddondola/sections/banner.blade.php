@section('banner')
    <section class="image-bg lis-grediant grediant-bt-dark text-white py-4 profile-inner">
        <div class="background-image-maker"></div>
        <div class="holder-image">
            <img src="{{ $user->coverPicture()['url'] }}" alt="" class="img-fluid d-none">
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-12 mb-4 mb-lg-0">
                    <a href="javascript:void(0)" class="text-white">
                        <div class="media d-block d-sm-flex text-sm-left text-center">
                            <img style="width: 100px; height: 100px; border-radius: 5px !important;" src="{{ $user->avatar()['url'] }}" class="img-fluid d-sm-flex mr-0 mr-sm-4 border border-white lis-border-width-4 mb-4 mb-md-0" alt="{{ $user->name() }}"/>
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
                    @auth
                        @if(Auth::user()->is($user))
                            <li class="nav-item"><a href="{{ route('my.profile') }}" class="nav-link @yield('profile-active')"><i class="material-icons">view_day</i> Activity</a></li>
                            <li class="nav-item"><a href="{{ route('my.followers') }}" class="nav-link @yield('followers-active')"><i class="material-icons">people</i> Followers</a></li>
                            <li class="nav-item"><a href="{{ route('my.following') }}" class="nav-link @yield('following-active')"><i class="material-icons">people_outline</i> Following</a></li>
                            <li class="nav-item"><a href="{{ route('my.notifications') }}" class="nav-link @yield('notifications-active')"><i class="material-icons">notifications_active</i> Notifications</a></li>
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
                @auth
                    @if(!Auth::user()->is($user))
                        <user-actions :user="{{ $user }}" my-messenger-url="{{ route("my.messenger") }}"></user-actions>
                    @endif
                @endauth
            </div>
        </div>
    </div>
</div>