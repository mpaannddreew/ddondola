@extends('shoppie::shop.admin.inventory.base')
@section('title')@parent Brands @endsection
@section('brands-active', 'active')
@section('inventory')
    <div class="container py-2" style="position: relative; top: -84px !important;">
        <shop-brands shop="{{ $shop->code }}"></shop-brands>
    </div>
@endsection