@extends('shoppie::shop.product.admin.base.product')
@section('reviews-active', 'active')
@section('product')
    <reviews :reviewable="{{ $product }}" reviewable-type="product"></reviews>
@endsection
