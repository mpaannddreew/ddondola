<div class="hero_in shop_detail">
    <div class="wrapper">
        <span class="magnific-gallery">
            <a href="/images/gallery/hotel_list_1.jpg" class="btn_photos" title="Photo title" data-effect="mfp-zoom-in"><i class="fa fa-picture-o"></i> View photos</a>
            <a href="/images/gallery/hotel_list_2.jpg" title="Photo title" data-effect="mfp-zoom-in"></a>
            <a href="/images/gallery/hotel_list_3.jpg" title="Photo title" data-effect="mfp-zoom-in"></a>
        </span>
    </div>
</div>
<nav class="secondary_nav sticky_horizontal_2">
    <div class="container">
        <ul class="clearfix">
            @if(Auth::user()->is($user))
                <li><a href="{{ route('my.profile') }}" class="@yield('profile-active')"><i class="fa fa-user-circle"></i> Profile</a></li>
                <li><a href="{{ route('my.profile.edit') }}" class="@yield('edit-active')"><i class="fa fa-pencil"></i> Edit</a></li>
                <li><a href="{{ route('my.followers') }}" class="@yield('followers-active')"><i class="fa fa-users"></i> Followers ({{ $user->followerCount() }})</a></li>
            @else
                <li><a href="{{ route('user.profile', ['user' => $user->code]) }}" class="@yield('profile-active')"><i class="fa fa-user-circle"></i> Profile</a></li>
                <li><a href="{{ route('user.followers', ['user' => $user->code]) }}" class="@yield('followers-active')"><i class="fa fa-users"></i> Followers ({{ $user->followerCount() }})</a></li>
            @endif
        </ul>
    </div>
</nav>