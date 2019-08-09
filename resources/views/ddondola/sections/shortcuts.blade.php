<ul class="nav flex-column home">
    <li class="nav-item @yield('home-active')">
        <a class="nav-link" href="{{ route('home') }}"><i class="material-icons">public</i> Home</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('my.dashboard') }}"><i class="material-icons">dashboard</i> Dashboard</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('my.profile') }}"><i class="material-icons">account_circle</i> Profile</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('my.orders') }}"><i class="material-icons">assignment</i> Orders</a>
    </li>
    <li class="nav-item @yield('people-active')">
        <a class="nav-link" href="{{ route('users.index') }}"><i class="material-icons">people</i> People</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('my.wishlist') }}"><i class="material-icons">favorite</i> Wishlist</a>
    </li>
    <li class="nav-item @yield('feedback-active')">
        <a class="nav-link" href="#"><i class="material-icons">headset_mic</i> Send Feedback</a>
    </li>
    <li class="nav-item @yield('help-active')">
        <a class="nav-link" href="#"><i class="material-icons">help</i> Help</a>
    </li>
</ul>
<div class="text-center py-2">
    <a class="btn btn-success w-100" href="{{ route('create.shop') }}"><i class="material-icons">add</i> New Shop</a>
</div>