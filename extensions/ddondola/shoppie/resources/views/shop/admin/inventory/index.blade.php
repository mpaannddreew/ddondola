@extends('shoppie::shop.admin.inventory.base')
@section('title')@parent Inventory @endsection
@section('home-active', 'active')
@section('inventory')
    <div class="container py-2" style="position: relative; top: -84px !important;">
        <shop-inventory shop="{{ $shop->code }}"></shop-inventory>
    </div>
@endsection