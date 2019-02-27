@extends('layouts.base.admin')
@section('title') {{ Auth::user()->name() }} - @endsection
@section('name') Account Admin @endsection
@section('nav-wrapper')
    <ul class="nav nav--no-borders flex-column">
        <li class="nav-item">
            <a class="nav-link " href="{{ route('home') }}">
                <i class="material-icons">public</i>
                <span>{{ config('app.name', 'Ddondola') }}</span>
            </a>
        </li>
    </ul>
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
        <li class="nav-item">
            <a class="nav-link @yield('notifications-active')" href="{{ route('my.notifications') }}">
                <i class="material-icons">notifications</i>
                <span>Notifications</span>
            </a>
        </li>
    </ul>
    <h6 class="main-sidebar__nav-title">Apps</h6>
    <ul class="nav nav--no-borders flex-column">
        <li class="nav-item">
            <a class="nav-link @yield('messenger-active')" href="{{ route('my.messenger') }}">
                <i class="material-icons">chat_bubble</i>
                <span>Messenger</span>
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
                <i class="material-icons">description</i>
                <span>Orders</span>
            </a>
        </li>
    </ul>
@endsection
