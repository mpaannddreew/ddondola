@extends('shoppie::shop.product.admin.base.product')
@section('title')@parent Reviews @endsection
@section('reviews-active', 'active')
@section('product')
    <reviews :reviewable="{{ $product }}" reviewable-type="product"></reviews>
@endsection
