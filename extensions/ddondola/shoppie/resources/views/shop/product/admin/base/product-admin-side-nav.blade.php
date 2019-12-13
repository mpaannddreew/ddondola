@extends('layouts.base.admin')
@section('title') {{ $product->name }} - @endsection
@section('logo')
    <img id="main-logo" class="d-inline-block align-top mr-1 rounded" style="max-width: 25px;" src="{{ $product->shop->avatar['url'] }}" alt="{{ $product->shop->name }}">
@endsection
@section('nav-wrapper')
    <h6 class="main-sidebar__nav-title">Dashboards</h6>
    <ul class="nav nav--no-borders flex-column">
        <li class="nav-item">
            <a class="nav-link @yield('dashboard-active')" href="{{ route('product.dashboard', ['product' => $product]) }}">
                <i class="material-icons">dashboard</i>
                <span>Dashboard</span>
            </a>
        </li>
    </ul>
    <h6 class="main-sidebar__nav-title">Product</h6>
    <ul class="nav nav--no-borders flex-column">
        <li class="nav-item">
            <a class="nav-link @yield('product-active')" href="{{ route('product', ['product' => $product]) }}">
                <i class="material-icons">description</i>
                <span>Details</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link @yield('edit-offers-active')" href="{{ route('product.offers', ['product' => $product]) }}">
                <i class="material-icons">date_range</i>
                <span>Offers</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link @yield('stock-active')" href="{{ route('product.stock', ['product' => $product]) }}">
                <i class="material-icons">local_offer</i>
                <span>Stock</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link @yield('gallery-active')" href="{{ route('product.gallery', ['product' => $product]) }}">
                <i class="material-icons">collections</i>
                <span>Gallery</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link @yield('edit-product-active')" href="{{ route('product.edit', ['product' => $product]) }}">
                <i class="material-icons">mode_edit</i>
                <span>Update Info</span>
            </a>
        </li>
    </ul>
@endsection
