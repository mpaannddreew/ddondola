<div class="hero_in shop_detail">
    <div class="wrapper">
        <span class="magnific-gallery">
            <a href="/images/gallery/hotel_list_1.jpg" class="btn_photos" title="Photo title" data-effect="mfp-zoom-in"><i class="fa fa-picture-o"></i> View photos</a>
            <a href="/images/gallery/hotel_list_2.jpg" title="Photo title" data-effect="mfp-zoom-in"></a>
            <a href="/images/gallery/hotel_list_3.jpg" title="Photo title" data-effect="mfp-zoom-in"></a>
        </span>
    </div>
</div>
<div class="header-navbar collapse d-lg-flex p-0 bg-white border-bottom">
    <div class="container p-0">
        <ul class="nav nav-tabs border-0 flex-column flex-lg-row @yield('user-nav-fill')">
            @if(Auth::user()->is($user))
                <li class="nav-item"><a href="{{ route('my.profile') }}" class="nav-link @yield('profile-active')"><i class="material-icons">account_circle</i> Profile</a></li>
                <li class="nav-item"><a href="{{ route('my.profile.edit') }}" class="nav-link @yield('edit-active')"><i class="material-icons">mode_edit</i> Edit</a></li>
            @else
                <li class="nav-item"><a href="{{ route('user.profile', ['user' => $user->code]) }}" class="nav-link @yield('profile-active')"><i class="material-icons">account_circle</i> Profile</a></li>
            @endif
        </ul>
    </div>
</div>