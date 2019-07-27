@extends('shoppie::shop.admin.base.admin')
@section('settings-active', 'active')
@section('page-header')
    <div class="page-header row no-gutters py-4">
        <div class="col">
            <span class="text-uppercase page-subtitle"><i class="fa fa-shopping-bag"></i> Shop</span>
            <h3 class="page-title">Update</h3>
        </div>
    </div>
@endsection
@section('header-navbar-class', 'border-bottom')
@section('tabs')
    <li class="nav-item">
        <a href="{{ route('my.shop.edit', ['shop' => $shop]) }}" class="nav-link @yield('info-active')">
            <i class="material-icons">mode_edit</i> Shop Info
        </a>
    </li>
@endsection