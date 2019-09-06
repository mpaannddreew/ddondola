@extends('shoppie::shop.product.admin.base.edit')
@section('title')@parent Offers @endsection
@section('edit-offers-active', 'active')
@section('page-header')
    <div class="page-header row no-gutters py-4">
        <div class="col">
            <span class="text-uppercase page-subtitle"><i class="material-icons">local_mall</i>  Product</span>
            <h3 class="page-title">Offers</h3>
        </div>
    </div>
@endsection
@section('main')
    <div class="container py-2">
        <offers :product="{{ $product }}"></offers>
    </div>
@endsection