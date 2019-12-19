@extends('ddondola.me.base.account-admin-icon-side-nav')
@section('title')@parent Shops @endsection
@section('shops-active', 'active')
@section('header-navbar-class', 'border-bottom')
@section('body-class') class="h-100 bg-white" @endsection
@section('tabs')
    <li class="nav-item">
        <a href="{{ route('my.shops') }}" class="nav-link @yield('mine-active')"><i class="material-icons">shop_two</i> Shops</a>
    </li>
    <li class="nav-item">
        <a href="{{ route('create.shop') }}" class="nav-link @yield('new-active')"><i class="material-icons">add</i> Create Shop</a>
    </li>
@endsection
@section('main')
    <div class="card card-small border-radius-0" style="background: unset !important;">
        <div class="card-header border-radius-0 profile-header" style="height: 82px !important;">
        </div>
        <div class="card-body p-0 profile-body bg-white border-top">
            @yield('shop')
        </div>
    </div>
@endsection
