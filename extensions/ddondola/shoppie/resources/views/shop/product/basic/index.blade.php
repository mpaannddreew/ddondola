@extends('layouts.base.ddondola-no-container')
@section('title')@parent {{ $product->name }} @endsection
@section('main')
    @include('shoppie::shop.product.sections.product', ['product' => $product])
@endsection
