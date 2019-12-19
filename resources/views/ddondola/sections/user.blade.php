<div class="card card-small border-radius-0" style="background: unset !important;">
    <div class="card-header border-radius-0 profile-header" style="height: 150px !important;">
    </div>
    <div class="card-body p-0 profile-body bg-white border-top">
        <div class="container" style="position: relative; top: -134px !important;">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="card card-small border border-bottom-radius-0">
                        <div class="card-header border-bottom">
                            <div class="row justify-content-center">
                                <div class="col-12 col-md-6 mb-4 mb-lg-0">
                                    <a href="javascript:void(0)">
                                        <div class="media d-block d-md-flex text-md-left text-center">
                                            <img style="width: 100px; height: 100px;" src="{{ $user->avatar()['url'] }}" class="img-fluid d-md-flex mr-4 border border-white mb-4 mb-md-0 rounded" alt="" />

                                            <div class="media-body align-self-center">
                                                <h5 class="lis-font-weight-500 lis-line-height-1 m-0">{{ $user->name }}</h5>
                                                <p class="m-0">
                                                    {{ $user->email }}
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-12 col-md-6 d-flex align-items-center">
                                    <div class="ml-auto">
                                        @auth
                                            @if(!auth()->user()->is($user))
                                                <user-actions :user="{{ $user }}" my-messenger-url="{{ route("my.messenger") }}"></user-actions>
                                            @else
                                                @can('create', Shoppie\Shop::class)
                                                    <a href="{{ route('create.shop') }}" class="btn btn-sm btn-success ml-auto">
                                                        <i class="fa fa-plus"></i> Create Shop
                                                    </a>
                                                @endcan
                                            @endif
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="header-navbar collapse d-lg-flex p-0 bg-light profile">
                                <div class="container p-0">
                                    <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                                        @auth
                                            @if(Auth::user()->is($user))
                                                <li class="nav-item">
                                                    <a href="{{ route('my.profile') }}" class="nav-link @yield('profile-active')">
                                                        <i class="material-icons">view_day</i> Activity
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="{{ route('my.followers') }}" class="nav-link @yield('followers-active')">
                                                        <i class="material-icons">people</i> Followers
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="{{ route('my.following') }}" class="nav-link @yield('following-active')">
                                                        <i class="material-icons">people_outline</i> Following
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="{{ route('my.notifications') }}" class="nav-link @yield('notifications-active')">
                                                        <i class="material-icons">notifications_active</i> Notifications
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="{{ route('my.profile.edit') }}" class="nav-link @yield('info-active')">
                                                        <i class="material-icons">mode_edit</i> Edit Info
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="{{ route('show.change.password') }}" class="nav-link @yield('password-active')">
                                                        <i class="material-icons">lock</i> Change Password
                                                    </a>
                                                </li>
                                            @else
                                                <li class="nav-item">
                                                    <a href="{{ route('user.profile', ['user' => $user]) }}" class="nav-link @yield('profile-active')">
                                                        <i class="material-icons">view_day</i> Activity
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="{{ route('user.followers', ['user' => $user]) }}" class="nav-link @yield('followers-active')">
                                                        <i class="material-icons">people</i> Followers
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="{{ route('user.following', ['user' => $user]) }}" class="nav-link @yield('following-active')">
                                                        <i class="material-icons">people_outline</i> Following
                                                    </a>
                                                </li>
                                            @endif
                                        @else
                                            <li class="nav-item">
                                                <a href="{{ route('user.profile', ['user' => $user]) }}" class="nav-link @yield('profile-active')">
                                                    <i class="material-icons">view_day</i> Activity
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="{{ route('user.followers', ['user' => $user]) }}" class="nav-link @yield('followers-active')">
                                                    <i class="material-icons">people</i> Followers
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="{{ route('user.following', ['user' => $user]) }}" class="nav-link @yield('following-active')">
                                                    <i class="material-icons">people_outline</i> Following
                                                </a>
                                            </li>
                                        @endauth
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-md-4 pr-1">
                            <user-information class="border-top-radius-0" :with-cover="false" :with-border="true" :user="{{ $user }}"></user-information>
                        </div>
                        <div class="col-md-8 pl-1">
                            @yield('profile')
                        </div>
                    </div>
                </div>
                <div class="col-md-1"></div>
            </div>
        </div>
    </div>
</div>