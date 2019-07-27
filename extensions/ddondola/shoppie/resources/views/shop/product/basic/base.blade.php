@extends('layouts.base.ddondola-no-container')
@section('title')@parent {{ $product->name }} @endsection
@section('meta')
    <meta property="og:type" content="product"/>
    <meta property="og:title" content="{{ $product->name }}"/>
    <meta property="og:description" content="{{ $product->description }}"/>
    <meta property="og:image" content="{{ $product->sampleImage()['url'] }}"/>
    <meta property="og:url" content="{{ route('product', ['product' => $product]) }}" />
@endsection
@section('body-class') class="h-100" @endsection
@section('custom-design')
    @include('shoppie::shop.product.sections.product', ['product' => $product])
@endsection
@section('header-navbar-class', 'border-top border-bottom')
@section('tabs')
    @include('shoppie::shop.product.sections.tabs', ['product' => $product])
@endsection
@section('main')
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
                        <h5 class="mb-0">{{ $product->shop()->name }}</h5>
                        <span class="text-muted d-block mb-2">{{ $product->shop()->profile('email') }}</span>
                        <mini-rating-meter :reviewable="{{ $product }}"></mini-rating-meter>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection