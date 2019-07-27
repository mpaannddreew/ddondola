@extends('shoppie::shop.product.basic.base')
@section('title')@parent Home @endsection
@section('meta')
    <meta property="og:type" content="product"/>
    <meta property="og:title" content="{{ $product->name }}"/>
    <meta property="og:description" content="{{ $product->description }}"/>
    <meta property="og:image" content="{{ $product->sampleImage()['url'] }}"/>
    <meta property="og:url" content="{{ route('product', ['product' => $product]) }}" />
@endsection
@section('home-active', 'active')
@section('product')
    @include('shoppie::shop.product.sections.details')
@endsection
