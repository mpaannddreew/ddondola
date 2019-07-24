@extends('ddondola.me.base.account-admin-icon-side-nav')
@section('title')@parent Shops @endsection
@section('shops-active', 'active')
@section('page-header')
    <div class="page-header row no-gutters py-4">
        <div class="col">
            <span class="text-uppercase page-subtitle"><i class="material-icons">account_circle</i> Account</span>
            <h3 class="page-title">Shops</h3>
        </div>
    </div>
@endsection
@section('header-navbar-class', 'border-bottom')
@section('tabs')
    <li class="nav-item">
        <a href="{{ route('my.shops') }}" class="nav-link @yield('mine-active')"><i class="material-icons">shop_two</i> Shops</a>
    </li>
    <li class="nav-item">
        <a href="{{ route('create.shop') }}" class="nav-link @yield('new-active')"><i class="material-icons">add</i> New Shop</a>
    </li>
@endsection

