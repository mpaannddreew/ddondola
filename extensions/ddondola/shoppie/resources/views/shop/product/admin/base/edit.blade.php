@extends('shoppie::shop.product.admin.base.admin')
@section('title')@parent Update @endsection
@section('edit-active', 'active')
@section('page-header')
    <div class="page-header row no-gutters py-4">
        <div class="col">
            <span class="text-uppercase page-subtitle"><i class="material-icons">local_mall</i>  Product</span>
            <h3 class="page-title">Update</h3>
        </div>
    </div>
@endsection
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