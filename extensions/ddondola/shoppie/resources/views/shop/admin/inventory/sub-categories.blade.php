@extends('shoppie::shop.admin.inventory.base')
@section('title')@parent Sub Categories @endsection
@section('sub-categories-active', 'active')
@section('inventory')
    <div class="container py-2" style="position: relative; top: -84px !important;">
        <shop-sub-categories inventory-url="{{ route('my.shop.inventory', ['shop' => $shop]) }}" shop="{{ $shop->code }}"></shop-sub-categories>
    </div>
@endsection