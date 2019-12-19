@extends('shoppie::shop.admin.inventory.base')
@section('title')@parent Categories @endsection
@section('categories-active', 'active')
@section('inventory')
    <div class="container py-2" style="position: relative; top: -84px !important;">
        <shop-categories shop="{{ $shop->code }}"></shop-categories>
    </div>
@endsection