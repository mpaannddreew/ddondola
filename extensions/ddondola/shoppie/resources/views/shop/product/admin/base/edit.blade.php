@extends('shoppie::shop.product.admin.base.admin')
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
            <i class="material-icons">mode_edit</i> Update
        </a>
    </li>
@endsection