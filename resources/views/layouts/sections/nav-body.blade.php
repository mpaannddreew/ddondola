<form action="#" class="main-navbar__search w-100 d-none d-md-flex d-lg-flex">
    <div class="input-group input-group-seamless ml-3">
        <div class="input-group-prepend">
            <div class="input-group-text">
                <i class="material-icons">search</i>
            </div>
        </div>
        <input class="navbar-search form-control" type="text" placeholder="Search" aria-label="Search">
    </div>
</form>
<ul class="navbar-nav border-left flex-row border-right ml-auto">
    @section('nav-items')
    <li is="nav-messenger"></li>
    <li is="nav-cart"></li>
    <li is="nav-tray"></li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-nowrap px-3" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            <img class="user-avatar rounded-circle mr-2" src="{{ asset('images/avatars/0.jpg') }}" alt="User Avatar"> <span class="d-none d-md-inline-block"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-small dropdown-menu-right">
            <a class="dropdown-item" href="{{ route('my.profile') }}"><i class="material-icons">account_circle</i> Profile</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ route('my.orders') }}"><i class="material-icons">description</i> Orders</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="material-icons text-danger">&#xE879;</i> Logout
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </li>
    @show
</ul>
<nav class="nav">
    <a href="#" class="nav-link nav-link-icon toggle-sidebar d-md-inline d-lg-none text-center " data-toggle="collapse" data-target=".header-navbar" aria-expanded="false" aria-controls="header-navbar">
        <i class="material-icons">&#xE5D2;</i>
    </a>
</nav>