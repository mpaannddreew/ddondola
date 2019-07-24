@extends('shoppie::base')
@section('title')@parent Products @endsection
@section('products-active', 'active')
@section('main')
    <product-directory @guest :auth="false" @endguest></product-directory>
@endsection
