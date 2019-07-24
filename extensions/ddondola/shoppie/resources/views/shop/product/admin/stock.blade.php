@extends('shoppie::shop.product.admin.base.admin')
@section('title')@parent Stock @endsection
@section('stock-active', 'active')
@section('page-header')
    <div class="page-header row no-gutters py-4">
        <div class="col">
            <span class="text-uppercase page-subtitle"><i class="material-icons">local_mall</i>  Product</span>
            <h3 class="page-title">Stock</h3>
        </div>
    </div>
@endsection
@section('main')
    <stock :product="{{ $product }}"></stock>
@endsection