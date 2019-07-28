@extends('shoppie::shop.product.admin.base.admin')
@section('product-active') active @endsection
@section('body-class') class="h-100" @endsection
@section('main')
    @include('shoppie::shop.product.sections.product')
    <div class="header-navbar collapse d-lg-flex p-0 bg-white border-top border-bottom sticky">
        <div class="container p-0">
            <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                @include('shoppie::shop.product.sections.tabs')
            </ul>
        </div>
    </div>
    @include('shoppie::shop.product.sections.base-holder')
@endsection