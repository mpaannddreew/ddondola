@extends('layouts.base.ddondola')
@section('title'){{ $product->name }} - @endsection
@section('body-class') class="h-100" @endsection
@section('header-navbar-class', '')
@section('main')
    @include('shoppie::shop.product.sections.product')
@endsection