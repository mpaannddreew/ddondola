<section class="image-bg lis-grediant grediant-bt-dark text-white pb-4 profile-inner">
    <div class="background-image-maker"></div>
    <div class="holder-image">
        <img src="{{ asset('images/hero-area.jpg') }}" alt="" class="img-fluid d-none">
    </div>
    <div class="container">
        <div class="row justify-content-center wow fadeInUp">
            <div class="col-12 col-md-12 mb-4 mb-lg-0">
                <a href="javascript:void(0)" class="text-white">
                    <div class="media d-block d-sm-flex text-sm-left text-center">
                        <img style="width: 100px; height: 100px;" src="{{ asset('images/avatars/0.jpg') }}" class="img-fluid d-sm-flex mr-0 mr-sm-4 border border-white lis-border-width-4 rounded mb-4 mb-md-0" alt="" />
                        <div class="media-body align-self-center">
                            <h5 class="text-white lis-font-weight-500 lis-line-height-1">{{ $user->name() }}</h5>
                            <p class="mb-0">Member since January,2013</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>
<div class="header-navbar collapse d-lg-flex p-0 bg-white border-bottom">
    <div class="container p-0">
        <div class="row">
            <div class="col-12 col-sm-6 text-center text-sm-left mb-4 mb-sm-0">
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row @yield('user-nav-fill')">
                    @if(Auth::user()->is($user))
                        <li class="nav-item"><a href="{{ route('my.profile') }}" class="nav-link @yield('profile-active')"><i class="material-icons">account_circle</i> Profile</a></li>
                        <li class="nav-item"><a href="{{ route('my.profile.edit') }}" class="nav-link @yield('edit-active')"><i class="material-icons">mode_edit</i> Edit</a></li>
                    @else
                        <li class="nav-item"><a href="{{ route('user.profile', ['user' => $user->code]) }}" class="nav-link @yield('profile-active')"><i class="material-icons">account_circle</i> Profile</a></li>
                    @endif
                </ul>
            </div>
            <div class="col-12 col-sm-6 d-flex align-items-center">
                <div class="btn-group btn-group-sm ml-auto mr-auto ml-sm-auto mr-sm-0 mt-3 mt-sm-0" role="group" aria-label="Table row actions">
                    <a href="javascript:void(0)" class="btn btn-white">
                        <i class="material-icons">person_add</i> Follow
                    </a>
                    <a href="javascript:void(0)" class="btn btn-white">
                        <i class="material-icons">message</i> Message
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>