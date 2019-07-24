@extends('shoppie::shop.admin.base.shop')
@section('title')@parent Home @endsection
@section('products-active', 'active')
@section('shop-profile')
    <shop-products :admin="true" shop="{{ $shop->code }}"></shop-products>
@endsection
