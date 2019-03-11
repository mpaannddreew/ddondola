@extends('layouts.base.ddondola')
@section('main')
    <div class="row">
        <div class="col-md-3 py-4 page-sidebar">
            <div class="profile-card">
                <img src="{{ asset('images/avatars/0.jpg') }}" alt="user" class="profile-photo">
                <h5><a href="{{ route('my.profile') }}" class="text-white">{{ Auth::user()->name() }}</a></h5>
                <a href="#" class="text-white"><i class="ion ion-android-person-add"></i> 1,299 followers</a>
            </div>
            <div class="card card-small widget categories border my-4">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Shortcuts</h6>
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
            <shop-suggestions></shop-suggestions>
        </div>
        <div class="col-md-6">
            @yield('page-content')
        </div>
        <div class="col-md-3 py-4">
            <top-products class="mb-4"></top-products>
            <shop-suggestions title="Most Visited Shops"></shop-suggestions>
        </div>
    </div>
@endsection
