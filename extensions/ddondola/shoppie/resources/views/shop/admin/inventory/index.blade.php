@extends('shoppie::shop.admin.inventory.base')
@section('title')@parent Inventory @endsection
@section('home-active', 'active')
@section('main')
    <div class="container py-2">
        <shop-inventory shop="{{ $shop->code }}"></shop-inventory>
    </div>
@endsection