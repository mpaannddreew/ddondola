@extends('shoppie::shop.product.admin.base.edit')
@section('page-header')
    <div class="page-header row no-gutters py-4">
        <div class="col">
            <span class="text-uppercase page-subtitle"><i class="material-icons">local_mall</i>  Product</span>
            <h3 class="page-title">Gallery</h3>
        </div>
    </div>
@endsection
@section('gallery-active', 'active')
@section('main')
    @if(has_media($product, 'products'))
        @include('shoppie::shop.product.sections.carousel')
    @endif
    <div class="container py-2">
        <div class="row">
            <div class="col-md-8 offset-2">
                <product-image-manager url="{{ route('product.gallery', ['product' => $product]) }}"></product-image-manager>
            </div>
        </div>
    </div>
@endsection