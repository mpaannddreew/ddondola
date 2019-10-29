@extends('layouts.base.admin')
@section('title') {{ auth()->user()->name() }} - @endsection
@section('name') Account Admin @endsection
@section('nav-wrapper')
    <h6 class="main-sidebar__nav-title">Dashboards</h6>
    <ul class="nav nav--no-borders flex-column">
        <li class="nav-item">
            <a class="nav-link @yield('dashboard-active')" href="{{ route('my.dashboard') }}">
                <i class="material-icons">dashboard</i>
                <span>Dashboard</span>
            </a>
        </li>
    </ul>
    <h6 class="main-sidebar__nav-title">Account</h6>
    <ul class="nav nav--no-borders flex-column">
        <li class="nav-item">
            <a class="nav-link @yield('profile-base-active')" href="{{ route('my.profile') }}">
                <i class="material-icons">account_circle</i>
                <span>Profile</span>
            </a>
        </li>
        @can('create', Shoppie\Shop::class)
        <li class="nav-item">
            <a class="nav-link @yield('shops-active')" href="{{ route('my.shops') }}">
                <i class="material-icons">shop_two</i>
                <span>Shops</span>
            </a>
        </li>
        @endcan
        <li class="nav-item">
            <a class="nav-link @yield('settings-active')" href="{{ route('my.profile.edit') }}">
                <i class="material-icons">settings</i>
                <span>Settings</span>
            </a>
        </li>
    </ul>
    <h6 class="main-sidebar__nav-title">Apps</h6>
    <ul class="nav nav--no-borders flex-column">
        <li class="nav-item">
            <a class="nav-link @yield('messenger-active')" href="{{ route('my.messenger') }}">
                <i class="material-icons">chat</i>
                <span>Messenger</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link @yield('wallet-active')" href="{{ route('my.wallet') }}">
                <i class="material-icons">account_balance_wallet</i>
                <span>Wallet</span>
            </a>
        </li>
    </ul>
    <h6 class="main-sidebar__nav-title">Shopping</h6>
    <ul class="nav nav--no-borders flex-column">
        <li class="nav-item">
            <a class="nav-link @yield('cart-active')" href="{{ route('my.cart') }}">
                <i class="material-icons">shopping_cart</i>
                <span>Cart</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link @yield('wishlist-active')" href="{{ route('my.wishlist') }}">
                <i class="fa fa-heart"></i>
                <span>Wishlist</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link @yield('orders-active')" href="{{ route('my.orders') }}">
                <i class="material-icons">assignment</i>
                <span>Orders</span>
            </a>
        </li>
    </ul>
@endsection
