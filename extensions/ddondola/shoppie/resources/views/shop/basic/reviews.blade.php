@extends('shoppie::shop.basic.base.basic')
@section('title')@parent Reviews @endsection
@section('reviews-active', 'active')
@section('shop-profile')
    @include('shoppie::shop.sections.review-section', ['shop' => $shop])
@endsection

