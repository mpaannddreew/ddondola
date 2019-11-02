<aside class="main-sidebar col-12 col-md-3 col-lg-2 px-0">
    <div class="main-navbar">
        <nav class="navbar align-items-stretch navbar-light bg-white flex-md-nowrap border-bottom p-0">
            <a class="navbar-brand w-100 mr-0 border-right" href="javascript:void(0)" style="line-height: 25px;">
                <div class="d-table m-auto">
                    @section('logo')
                    <span class="d-none d-md-inline ml-1">@yield('name')</span>
                    @show
                </div>
            </a>
            <a class="toggle-sidebar d-sm-inline d-md-none d-lg-none">
                <i class="material-icons">&#xE5C4;</i>
            </a>
        </nav>
    </div>
    <div class="nav-wrapper border-right">
        @yield('nav-wrapper')
    </div>
</aside>