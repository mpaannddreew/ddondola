@extends('layouts.base.admin')
@section('title') {{ $product->name }} - @endsection
@section('logo')
    <img id="main-logo" class="d-inline-block align-top mr-1" style="max-width: 25px;" src="{{ $product->shop->avatar['url'] }}" alt="{{ $product->shop->name }}">
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
            <a class="nav-link @yield('edit-active')" href="{{ route('product.edit', ['product' => $product]) }}">
                <i class="material-icons">mode_edit</i>
                <span>Update</span>
            </a>
        </li>
    </ul>
@endsection
