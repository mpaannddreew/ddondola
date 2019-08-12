@extends('shoppie::shop.product.admin.base.admin')
@section('title')@parent Update @endsection
@section('edit-active', 'active')
@section('header-navbar-class', 'border-bottom')
@section('tabs')
    <li class="nav-item">
        <a href="{{ route('product.edit', ['product' => $product]) }}" class="nav-link @yield('edit-product-active')">
            <i class="material-icons">mode_edit</i> Info
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link @yield('gallery-active')" href="{{ route('product.gallery', ['product' => $product]) }}">
            <i class="material-icons">collections</i> Gallery
        </a>
    </li>
@endsection