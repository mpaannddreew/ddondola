<div class="container py-2">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <div class="row">
                <div class="col-md-4 px-1">
                    <user-information :user="{{ $user }}" :with-border="true" >
                        <p class="text-center my-2">
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
                        </p>
                    </user-information>
                </div>
                <div class="col-md-8 px-1">
                    <div class="header-navbar collapse d-lg-flex p-0 bg-white border mb-1">
                        <div class="container p-0">
                            <ul class="nav nav-tabs nav-justified border-0 flex-column flex-lg-row" id="profile">
                                @auth
                                    @if(Auth::user()->is($user))
                                        <li class="nav-item"><a href="{{ route('my.profile') }}" class="nav-link @yield('profile-active')"><i class="material-icons">view_day</i> Activity</a></li>
                                        <li class="nav-item"><a href="{{ route('my.followers') }}" class="nav-link @yield('followers-active')"><i class="material-icons">people</i> Followers</a></li>
                                        <li class="nav-item"><a href="{{ route('my.following') }}" class="nav-link @yield('following-active')"><i class="material-icons">people_outline</i> Following</a></li>
                                        <li class="nav-item dropdown">
                                            <a class="nav-link @yield('following-settings')" data-toggle="dropdown"><i class="material-icons">settings</i> Settings</a>
                                            <div class="dropdown-menu dropdown-menu-small">
                                                <a href="{{ route('my.profile.edit') }}" class="dropdown-item"><i class="material-icons">mode_edit</i> Edit Profile</a>
                                                <a href="{{ route('show.change.password') }}" class="dropdown-item"><i class="material-icons">lock</i> Change Password</a>
                                                <a href="{{ route('my.notifications') }}" class="dropdown-item"><i class="material-icons">notifications_active</i> Notifications</a>
                                            </div>
                                        </li>
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
                    </div>
                    @yield('profile')
                </div>
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>
</div>