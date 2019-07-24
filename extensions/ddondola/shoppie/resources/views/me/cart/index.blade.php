@extends('shoppie::me.cart.base')
@section('title')@parent Cart @endsection
@section('index-active', 'active')
@section('page-header')
    <div class="page-header row no-gutters py-4">
        <div class="col">
            <span class="text-uppercase page-subtitle"><i class="fa fa-shopping-bag"></i> Shopping</span>
            <h3 class="page-title">Cart</h3>
        </div>
    </div>
@endsection
@section('main')
    <div class="container py-2">
        <cart></cart>
    </div>
@endsection
