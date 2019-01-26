@extends('layouts.base.ddondola')
@section('main')
    <div class="row my-4">
        <div class="col-md-3 mb-4 page-sidebar">
            <profile-card profile-url="{{ route('my.profile') }}"></profile-card>
            <div class="widget categories">
                <ul class="categories-list">
                    <li>
                        <a href="{{ route('home') }}">
                            <i class="fa fa-globe"></i>
                            Home
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
                        <a href="{{ route('my.orders') }}">
                            <i class="material-icons">description</i>
                            Orders
                            <span class="category-counter"><i class="fa fa-list-alt"></i></span>
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
                        <a href="{{ route('my.cart') }}">
                            <i class="fa fa-shopping-cart"></i>
                            Shopping cart
                            <span class="category-counter"><i class="fa fa-list"></i></span>
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
                </ul>
            </div>
        </div>
        @section('right-side')
            <div class="col-md-6 mb-4">
                @yield('page-content')
            </div>
            <div class="col-md-3 mb-4"></div>
            @show
    </div>
@endsection
