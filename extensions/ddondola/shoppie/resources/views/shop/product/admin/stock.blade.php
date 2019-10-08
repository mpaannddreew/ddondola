@extends('shoppie::shop.product.admin.base.edit')
@section('title')@parent Stock @endsection
@section('stock-active', 'active')
@section('main')
    <stock :product="{{ $product }}"></stock>
@endsection