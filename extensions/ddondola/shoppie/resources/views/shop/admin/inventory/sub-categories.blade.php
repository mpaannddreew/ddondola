@extends('shoppie::shop.admin.inventory.base')
@section('title')@parent Sub Categories @endsection
@section('sub-categories-active', 'active')
@section('main')
    <div class="container py-2">
        <shop-sub-categories inventory-url="{{ route('my.shop.inventory', ['shop' => $shop]) }}" shop="{{ $shop->code }}"></shop-sub-categories>
    </div>
@endsection
