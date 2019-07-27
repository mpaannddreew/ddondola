@extends('shoppie::shop.product.admin.base.edit')
@section('title')@parent Edit @endsection
@section('edit-product-active', 'active')
@section('main')
    <div class="container py-2">
        <div class="row">
            <div class="col-md-8 offset-2">
                <edit-product :product="{{ $product }}"></edit-product>
            </div>
        </div>
    </div>
@endsection