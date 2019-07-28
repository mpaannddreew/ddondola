@extends('layouts.base.ddondola-no-container')
@section('title'){{ $product->name }} - @endsection
@section('body-class') class="h-100" @endsection
@section('custom-design')
    @include('shoppie::shop.product.sections.product')
@endsection
@section('header-navbar-class', 'border-top border-bottom')
@section('tabs')
    @include('shoppie::shop.product.sections.tabs')
@endsection
@section('main')
    @include('shoppie::shop.product.sections.base-holder')
@endsection