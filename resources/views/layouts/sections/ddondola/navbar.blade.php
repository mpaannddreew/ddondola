<div class="main-navbar sticky-top bg-white">
    <div class="container p-0">
        <!-- Main Navbar -->
        <nav class="navbar align-items-stretch navbar-light flex-md-nowrap p-0">
            <a class="navbar-brand" href="{{ route('home') }}" style="line-height: 25px;">
                <div class="d-table m-auto">
                    <span class="d-none d-md-inline ml-1">{{ config('app.name', 'Ddondola') }}</span>
                </div>
            </a>
            @include('layouts.sections.nav-body')
        </nav>
    </div> <!-- / .container -->
</div> <!-- / .main-navbar -->