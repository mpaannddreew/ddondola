@extends('shoppie::shop.product.admin.base.edit')
@section('title')@parent Offers @endsection
@section('edit-offers-active', 'active')
@section('main')
    <div class="container py-2">
        <offers :product="{{ $product }}"></offers>
    </div>
@endsection