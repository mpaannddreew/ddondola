<aside class="main-sidebar col-12 col-md-3 col-lg-2 px-0 border-right">
    <div class="main-navbar">
        <nav class="navbar align-items-stretch navbar-light bg-white flex-md-nowrap border-bottom p-0">
            <a class="navbar-brand w-100 mr-0" href="#" style="line-height: 25px;">
                <div class="d-table m-auto">
                    <span class="d-none d-md-inline ml-1">@yield('name')</span>
                </div>
            </a>
            <a class="toggle-sidebar d-sm-inline d-md-none d-lg-none">
                <i class="material-icons">&#xE5C4;</i>
            </a>
        </nav>
    </div>
    <form action="#" class="main-sidebar__search w-100 border-right d-sm-flex d-md-none d-lg-none">
        <div class="input-group input-group-seamless ml-3">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <i class="material-icons">search</i>
                </div>
            </div>
            <input class="navbar-search form-control" type="text" placeholder="Search" aria-label="Search">
        </div>
    </form>
    <div class="nav-wrapper">
        @yield('nav-wrapper')
    </div>
</aside>