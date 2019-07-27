@extends('shoppie::shop.product.basic.base')
@section('title')@parent Reviews @endsection
@section('reviews-active', 'active')
@section('product')
    <reviews :reviewable="{{ $product }}" reviewable-type="product"></reviews>
@endsection
