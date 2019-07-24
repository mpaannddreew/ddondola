@extends('ddondola.me.base.account-admin-icon-side-nav')
@section('cart-active', 'active')
@section('header-navbar-class', 'border-bottom')
@section('tabs')
    <li class="nav-item">
        <a href="{{ route('my.cart') }}" class="nav-link @yield('index-active')"><i class="material-icons">shopping_cart</i> Cart</a>
    </li>
    <li class="nav-item">
        <a href="{{ route('my.cart.checkout') }}" class="nav-link @yield('checkout-active')"><i class="material-icons">check</i> Checkout</a>
    </li>
@endsection

