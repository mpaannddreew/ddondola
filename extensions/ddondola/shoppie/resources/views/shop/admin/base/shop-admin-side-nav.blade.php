@extends('layouts.base.admin')
@section('title') {{ $shop->name }} - @endsection
@section('name') Shop Admin @endsection
@section('nav-wrapper')
    <h6 class="main-sidebar__nav-title">Dashboards</h6>
    <ul class="nav nav--no-borders flex-column">
        <li class="nav-item">
            <a class="nav-link @yield('dashboard-active')" href="{{ route('my.shop.dashboard', ['shop' => $shop->code]) }}">
                <i class="material-icons">dashboard</i>
                <span>Dashboard</span>
            </a>
        </li>
    </ul>
    <h6 class="main-sidebar__nav-title">Shop</h6>
    <ul class="nav nav--no-borders flex-column">
        <li class="nav-item">
            <a class="nav-link @yield('profile-base-active')" href="{{ route('shop', ['shop' => $shop->code]) }}">
                <i class="material-icons">shop_two</i>
                <span>Shop</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link @yield('settings-active')" href="{{ route('my.shop.settings', ['shop' => $shop->code]) }}">
                <i class="material-icons">settings</i>
                <span>Settings</span>
            </a>
        </li>
    </ul>
    <h6 class="main-sidebar__nav-title">Business</h6>
    <ul class="nav nav--no-borders flex-column">
        <li class="nav-item">
            <a class="nav-link @yield('inventory-active')" href="{{ route('my.shop.inventory', ['shop' => $shop->code]) }}">
                <i class="material-icons">local_mall</i>
                <span>Inventory</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link @yield('orders-active')" href="{{ route('my.shop.orders', ['shop' => $shop->code]) }}">
                <i class="material-icons">assignment</i>
                <span>Orders</span>
            </a>
        </li>
    </ul>
    <h6 class="main-sidebar__nav-title">Apps</h6>
    <ul class="nav nav--no-borders flex-column">
        <li class="nav-item">
            <a class="nav-link @yield('messenger-active')" href="{{ route('my.shop.messenger', ['shop' => $shop->code]) }}">
                <i class="material-icons">chat</i>
                <span>Messenger</span>
            </a>
        </li>
    </ul>
@endsection
