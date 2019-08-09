@extends('shoppie::shop.admin.base.shop')
@section('title')@parent Home @endsection
@section('banner', '')
@section('products-active', 'active')
@section('shop-profile')
    <shop-products :admin="true" :shop="{{ $shop }}"></shop-products>
@endsection
