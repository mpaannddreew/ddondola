@extends('shoppie::shop.product.basic.base')
@section('reviews-active', 'active')
@section('product')
    <reviews :reviewable="{{ $product }}" reviewable-type="product"></reviews>
@endsection
