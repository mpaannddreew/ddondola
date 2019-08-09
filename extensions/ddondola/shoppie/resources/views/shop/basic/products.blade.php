@extends('shoppie::shop.basic.base.basic')
@section('title')@parent Home @endsection
@section('banner', '')
@section('products-active', 'active')
@section('shop-profile')
    <shop-products :shop="{{ $shop }}"></shop-products>
@endsection
