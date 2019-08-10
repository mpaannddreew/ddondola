@extends('shoppie::shop.product.admin.base.edit')
@section('stylesheets')
    @parent
    <link rel="stylesheet" href="{{ asset('website/welcome.css') }}" />
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