@extends('shoppie::shop.admin.base.admin')
@section('title')@parent Orders @endsection
@section('orders-active', 'active')
@section('main')
    <shop-order-directory></shop-order-directory>
@endsection