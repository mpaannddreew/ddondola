@extends('layouts.base.ddondola-no-container')
@section('title'){{ $product->name }} - @endsection
@section('body-class') class="h-100" @endsection
@section('header-navbar-class', '')
@section('main')
    @include('shoppie::shop.product.sections.product')
@endsection