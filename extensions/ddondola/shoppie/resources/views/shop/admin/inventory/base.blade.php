@extends('shoppie::shop.admin.base.admin')
@section('inventory-active', 'active')
@section('header-navbar-class', 'border-bottom')
@section('page-header')
    <div class="page-header row no-gutters py-4">
        <div class="col">
            <span class="text-uppercase page-subtitle"><i class="fa fa-shopping-bag"></i> Shop</span>
            <h3 class="page-title">Inventory</h3>
        </div>
    </div>
@endsection
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
        <a href="{{ route('my.shop.brands', ['shop' => $shop]) }}" class="nav-link @yield('brands-active')"><i class="material-icons">folder_open</i> Brands</a>
    </li>
    <li class="nav-item">
        <a href="{{ route('my.shop.inventory.new-product', ['shop' => $shop]) }}" class="nav-link @yield('new-product-active')"><i class="material-icons">add</i> New Product</a>
    </li>
@endsection
