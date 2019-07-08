@auth
<ul class="navbar-nav flex-row ml-auto">
    <li class="nav-item border-right dropdown notifications border-radius">
        <a class="nav-link nav-link-icon text-center" href="{{ route('home') }}">
            <div class="nav-link-icon__wrapper">
                <i class="material-icons">public</i>
            </div>
        </a>
    </li>
</ul>
@endauth
<search></search>
<ul class="navbar-nav border-left flex-row border-right ml-auto">
    @section('nav-items')
        @auth
            <li is="nav-messenger" home-url="/me/messenger"></li>
            <li is="nav-cart"></li>
            <li is="nav-tray"></li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-nowrap px-3" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <img class="user-avatar rounded-circle mr-2" src="{{ Auth::user()->avatar()['url'] }}" alt="User Avatar" style="border: medium solid #fff;">
                    <span class="d-none d-md-inline-block text-white">Hi, {{ Auth::user()->first_name }}!</span>
                </a>
                <div class="dropdown-menu dropdown-menu-small dropdown-menu-right">
                    @is_staff(Auth::user())
                    <a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i class="material-icons">apps</i> Administration</a>
                    <div class="dropdown-divider"></div>
                    @endis_staff
                    <a class="dropdown-item" href="{{ route('my.profile') }}"><i class="material-icons">account_circle</i> Profile</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('my.settings') }}"><i class="material-icons">settings</i> Settings</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="material-icons text-danger">&#xE879;</i> Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        @else
            <li class="nav-item border-right dropdown notifications border-radius">
                <a class="nav-link nav-link-icon text-center" href="{{ route('login') }}">
                    <div class="nav-link-icon__wrapper">
                        <i class="material-icons">lock_open</i>
                    </div>
                </a>
            </li>
            <li class="nav-item border-right dropdown notifications border-radius">
                <a class="nav-link nav-link-icon text-center" href="{{ route('register') }}">
                    <div class="nav-link-icon__wrapper">
                        <i class="material-icons">person_add</i>
                    </div>
                </a>
            </li>
        @endauth
    @show
</ul>
<nav class="nav">
    <a href="#" class="nav-link nav-link-icon toggle-sidebar d-md-inline d-lg-none text-center " data-toggle="collapse" data-target=".header-navbar" aria-expanded="false" aria-controls="header-navbar">
        <i class="material-icons">&#xE5D2;</i>
    </a>
</nav>