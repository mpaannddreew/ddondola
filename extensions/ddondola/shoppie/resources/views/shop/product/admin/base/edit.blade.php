@extends('shoppie::shop.product.admin.base.admin')
@section('edit-active', 'active')
@section('header-navbar-class', 'border-bottom')
@section('tabs')
    <li class="nav-item">
        <a class="nav-link @yield('edit-product-active')" href="{{ route('product.edit', ['product' => $product]) }}">
            <i class="material-icons">info_outline</i> Info
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link @yield('edit-offers-active')" href="{{ route('product.offers', ['product' => $product]) }}">
            <i class="material-icons">date_range</i> Offers
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link @yield('stock-active')" href="{{ route('product.stock', ['product' => $product]) }}">
            <i class="material-icons">local_offer</i> Stock
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link @yield('gallery-active')" href="{{ route('product.gallery', ['product' => $product]) }}">
            <i class="material-icons">collections</i> Gallery
        </a>
    </li>
@endsection