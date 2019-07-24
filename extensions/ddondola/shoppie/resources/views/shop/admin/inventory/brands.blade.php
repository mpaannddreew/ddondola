@extends('shoppie::shop.admin.inventory.base')
@section('title')@parent Brands @endsection
@section('brands-active', 'active')
@section('main')
    <div class="container py-2">
        <shop-brands shop="{{ $shop->code }}"></shop-brands>
    </div>
@endsection