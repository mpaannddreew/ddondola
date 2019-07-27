@extends('shoppie::shop.product.admin.base.product')
@section('title')@parent Home @endsection
@section('home-active', 'active')
@section('product')
    @include('shoppie::shop.product.sections.details')
@endsection