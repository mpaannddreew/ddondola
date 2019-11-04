@extends('ddondola.me.base.account-admin-icon-side-nav')
@section('title')@parent Shops @endsection
@section('shops-active', 'active')
@section('header-navbar-class', 'border-bottom')
@section('tabs')
    <li class="nav-item">
        <a href="{{ route('my.shops') }}" class="nav-link @yield('mine-active')"><i class="material-icons">shop_two</i> Shops</a>
    </li>
    <li class="nav-item">
        <a href="{{ route('create.shop') }}" class="nav-link @yield('new-active')"><i class="material-icons">add</i> Create Shop</a>
    </li>
@endsection

