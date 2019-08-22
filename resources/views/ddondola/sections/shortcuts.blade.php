<div class="card card-small mb-4 pt-3 border">
    <div class="card-body text-center">
        <div class="mb-3 mx-auto">
            <img class="rounded-circle w-50" src="{{ Auth::user()->avatar()['url'] }}" alt="User Avatar">
        </div>
        <h6 class="mb-2 text-ellipsis">{{ Auth::user()->name() }}</h6>
        <a href="{{ route('my.profile') }}" class="mb-2 btn btn-sm btn-pill btn-outline-primary"><i class="material-icons mr-1">account_circle</i>Profile</a>
    </div>

</div>
<ul class="nav flex-column home">
    <li class="nav-item @yield('home-active')">
        <a class="nav-link" href="{{ route('home') }}"><i class="material-icons">public</i> Home</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('shops') }}"><i class="material-icons">shop_two</i> Shops</a>
    </li>
    <li class="nav-item @yield('people-active')">
        <a class="nav-link" href="{{ route('users.index') }}"><i class="material-icons">people</i> People</a>
    </li>
    <li class="nav-item @yield('feedback-active')">
        <a class="nav-link" href="#"><i class="material-icons">headset_mic</i> Send Feedback</a>
    </li>
    <li class="nav-item @yield('help-active')">
        <a class="nav-link" href="#"><i class="material-icons">help</i> Help</a>
    </li>
</ul>
<div class="text-center py-2">
    <a class="btn btn-success w-100" href="{{ route('create.shop') }}">Create your own shop</a>
</div>