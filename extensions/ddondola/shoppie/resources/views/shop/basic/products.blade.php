@extends('shoppie::shop.basic.base.basic')
@section('title')@parent Home @endsection
@section('products-active', 'active')
@section('shop-profile')
    <shop-products shop="{{ $shop->code }}"></shop-products>
@endsection
