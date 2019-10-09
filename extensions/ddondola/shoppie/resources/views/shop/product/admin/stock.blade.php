@extends('shoppie::shop.product.admin.base.edit')
@section('title')@parent Stock @endsection
@section('stock-active', 'active')
@section('main')
    <div class="container py-2">
        <stock :product="{{ $product }}"></stock>
    </div>
@endsection