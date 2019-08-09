<div class="main-navbar sticky-top">
    <div class="container p-0">
        <!-- Main Navbar -->
        <nav class="navbar align-items-stretch navbar-light flex-md-nowrap p-0">
            <a class="navbar-brand m-0" href="{{ route('home') }}" style="line-height: 25px;" title="Home">
                <div class="d-table m-auto">
                    <span class="d-none d-md-inline ml-1">
                        <img class="img-fluid" src="{{ asset('images/logo/logo.png') }}" style="width: 50px;" alt="{{ config('app.name', 'Ddondola') }}">
                    </span>
                </div>
            </a>
            @include('layouts.sections.nav-body')
        </nav>
    </div> <!-- / .container -->
</div> <!-- / .main-navbar -->