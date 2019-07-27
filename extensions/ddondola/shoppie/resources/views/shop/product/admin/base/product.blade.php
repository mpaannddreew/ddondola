@extends('shoppie::shop.product.admin.base.admin')
@section('title')@parent Home @endsection
@section('product-active') active @endsection
@section('body-class') class="h-100" @endsection
@section('main')
    @include('shoppie::shop.product.sections.product', ['product' => $product])
    <div class="header-navbar collapse d-lg-flex p-0 bg-white border-top border-bottom sticky">
        <div class="container p-0">
            <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                @include('shoppie::shop.product.sections.tabs', ['product' => $product])
            </ul>
        </div>
    </div>
    <div class="container py-2">
        <div class="row">
            <div class="col-md-3 px-1">
                <rating-meter :reviewable="{{ $product }}"></rating-meter>
            </div>
            <div class="col-md-6 px-1">
                @yield('product')
            </div>
            <div class="col-md-3 px-1">
                <div class="card card-small border">
                    <div class="card-body text-center">
                        <h4 class="mb-0">{{ $product->shop()->name }}</h4>
                        <span class="text-muted d-block mb-2">{{ $product->shop()->profile('email') }}</span>
                        <mini-rating-meter :reviewable="{{ $product }}"></mini-rating-meter>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection