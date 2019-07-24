@extends('shoppie::shop.product.admin.base.admin')
@section('title')@parent Home @endsection
@section('product-active') active @endsection
@section('body-class') class="h-100" @endsection
@section('main')
    @include('shoppie::shop.product.sections.product', ['product' => $product])
@endsection