@extends('shoppie::shop.admin.inventory.base')
@section('title')@parent Categories @endsection
@section('categories-active', 'active')
@section('main')
    <div class="container py-2">
        <shop-categories shop="{{ $shop->code }}"></shop-categories>
    </div>
@endsection
