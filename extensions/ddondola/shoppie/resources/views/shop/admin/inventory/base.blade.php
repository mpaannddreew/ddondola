@extends('shoppie::shop.admin.base.admin')
@section('inventory-active', 'active')
@section('header-navbar-class', 'border-bottom')
@section('body-class') class="h-100 bg-white" @endsection
@section('tabs')
    <li class="nav-item">
        <a href="{{ route('my.shop.inventory', ['shop' => $shop]) }}" class="nav-link @yield('home-active')"><i class="material-icons">local_mall</i> Products</a>
    </li>
    <li class="nav-item">
        <a href="{{ route('my.shop.categories', ['shop' => $shop]) }}" class="nav-link @yield('categories-active')"><i class="material-icons">folder_open</i> Categories</a>
    </li>
    <li class="nav-item">
        <a href="{{ route('my.shop.sub-categories', ['shop' => $shop]) }}" class="nav-link @yield('sub-categories-active')"><i class="material-icons">folder_open</i> Sub Categories</a>
    </li>
    <li class="nav-item">
        <a href="{{ route('my.shop.brands', ['shop' => $shop]) }}" class="nav-link @yield('brands-active')"><i class="material-icons">folder_open</i> Brands (Optional)</a>
    </li>
    <li class="nav-item">
        <a href="{{ route('my.shop.inventory.new-product', ['shop' => $shop]) }}" class="nav-link @yield('new-product-active')"><i class="material-icons">add</i> New Product</a>
    </li>
@endsection
@section('main')
    <div class="card card-small border-radius-0" style="background: unset !important;">
        <div class="card-header border-radius-0 profile-header" style="height: 82px !important;">
        </div>
        <div class="card-body p-0 profile-body bg-white border-top">
            @yield('inventory')
        </div>
    </div>
@endsection
