<ul class="nav nav-tabs border-0 mt-auto">
    @auth
        @if(Auth::user()->is($user))
                <li class="nav-item"><a href="{{ route('my.profile') }}" class="nav-link @yield('profile-active')"><i class="material-icons">event</i> Events</a></li>
                <li class="nav-item"><a href="{{ route('my.followers') }}" class="nav-link @yield('followers-active')"><i class="material-icons">people</i> Followers</a></li>
                <li class="nav-item"><a href="{{ route('my.following') }}" class="nav-link @yield('following-active')"><i class="material-icons">people_outline</i> Following</a></li>
                <li class="nav-item"><a href="{{ route('my.notifications') }}" class="nav-link @yield('notifications-active')"><i class="material-icons">notifications_active</i> Notifications</a></li>
        @else
                <li class="nav-item"><a href="{{ route('user.profile', ['user' => $user]) }}" class="nav-link @yield('profile-active')"><i class="material-icons">event</i> Events</a></li>
                <li class="nav-item"><a href="{{ route('user.followers', ['user' => $user]) }}" class="nav-link @yield('followers-active')"><i class="material-icons">people</i> Followers</a></li>
                <li class="nav-item"><a href="{{ route('user.following', ['user' => $user]) }}" class="nav-link @yield('following-active')"><i class="material-icons">people_outline</i> Following</a></li>
        @endif
    @else
        <li class="nav-item"><a href="{{ route('user.profile', ['user' => $user]) }}" class="nav-link @yield('profile-active')"><i class="material-icons">event</i> Events</a></li>
        <li class="nav-item"><a href="{{ route('user.followers', ['user' => $user]) }}" class="nav-link @yield('followers-active')"><i class="material-icons">people</i> Followers</a></li>
        <li class="nav-item"><a href="{{ route('user.following', ['user' => $user]) }}" class="nav-link @yield('following-active')"><i class="material-icons">people_outline</i> Following</a></li>
    @endauth
</ul>