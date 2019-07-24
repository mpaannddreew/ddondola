@extends('shoppie::me.cart.base')
@section('title')@parent Checkout @endsection
@section('checkout-active', 'active')
@section('page-header')
    <div class="page-header row no-gutters py-4">
        <div class="col">
            <span class="text-uppercase page-subtitle"><i class="fa fa-shopping-bag"></i> Shopping</span>
            <h3 class="page-title">Checkout</h3>
        </div>
    </div>
@endsection
@section('main')
    <div class="container py-2">
        <checkout></checkout>
    </div>
@endsection