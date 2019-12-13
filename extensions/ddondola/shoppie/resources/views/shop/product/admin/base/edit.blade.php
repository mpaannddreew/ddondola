@extends('shoppie::shop.product.admin.base.admin')
@section('edit-active', 'active')
@section('page-header')
    <div class="page-header row no-gutters py-4">
        <div class="col">
            <span class="text-uppercase page-subtitle"><i class="material-icons">local_mall</i> Product</span>
            <h3 class="page-title">@yield('page-title')</h3>
        </div>
    </div>
@endsection