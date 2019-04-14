@extends('layouts.base.ddondola')
@section('main')
    <div class="row">
        <div class="col-md-3 py-4 px-2">
            <div class=" page-sidebar">
                <div class="profile-card border">
                    <img src="{{ Auth::user()->avatar()['url'] }}" alt="user" class="profile-photo">
                    <h5 class="text-ellipsis"><a href="{{ route('my.profile') }}">{{ Auth::user()->name() }}</a></h5>
                    <a href="{{ route("my.followers") }}"><i class="ion ion-android-person-add"></i> {{ Auth::user()->viewFollower() }}</a>
                </div>
                <div class="card card-small widget categories my-2 border">
                    <div class="card-header border-bottom">
                        <h5 class="m-0"><i class="material-icons">short_text</i> Shortcuts</h5>
                    </div>
                    <div class="card-body p-0">
                        <ul class="categories-list">
                            <li>
                                <a href="{{ route('home') }}">
                                    <i class="fa fa-globe"></i>
                                    Home
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="{{ route('my.orders') }}">
                                    <i class="material-icons">description</i>
                                    Orders
                                    <span class="category-counter"><i class="fa fa-list-alt"></i></span>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="{{ route('my.wishlist') }}">
                                    <i class="fa fa-heart"></i>
                                    Wishlist
                                    <span class="category-counter"><i class="fa fa-folder-open"></i></span>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="{{ route('my.messenger') }}">
                                    <i class="material-icons">chat_bubble</i>
                                    Messages
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="{{ route('shops') }}">
                                    <i class="fa fa-shopping-bag"></i>
                                    Discover shops
                                    <span class="category-counter"><i class="fa fa-search"></i></span>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="{{ route('products') }}">
                                    <i class="fa fa-shopping-basket"></i>
                                    Discover products
                                    <span class="category-counter"><i class="fa fa-search"></i></span>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="{{ route('users.index') }}">
                                    <i class="fa fa-users"></i>
                                    Find shopping partners
                                    <span class="category-counter"><i class="fa fa-search"></i></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 py-4 px-2">
            @yield('page-content')
        </div>
        <div class="col-md-3 py-4 px-2">
            @include('shoppie::shop.sections.shop-card')
        </div>
    </div>
@endsection
