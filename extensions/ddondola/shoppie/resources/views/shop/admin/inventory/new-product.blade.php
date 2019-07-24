@extends('shoppie::shop.admin.inventory.base')
@section('title')@parent New Product @endsection
@section('new-product-active', 'active')
@section('main')
    <div class="container py-2">
        <div class="row">
            <div class="col-md-8 offset-2">
                <new-product inventory-url="{{ route('my.shop.inventory', ['shop' => $shop]) }}" :shop="{{ $shop }}"></new-product>
            </div>
        </div>
    </div>
@endsection