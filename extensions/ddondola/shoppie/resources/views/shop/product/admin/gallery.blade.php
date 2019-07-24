@extends('shoppie::shop.product.admin.base.admin')
@section('title')@parent Gallery @endsection
@section('gallery-active', 'active')
@section('page-header')
    <div class="page-header row no-gutters py-4">
        <div class="col">
            <span class="text-uppercase page-subtitle"><i class="material-icons">local_mall</i>  Product</span>
            <h3 class="page-title">Gallery</h3>
        </div>
    </div>
@endsection
@section('main')
    <div class="container py-2">
        <div class="card card-small mb-3">
            <div class="row no-gutters">
                <div class="file-manager-cards__dropzone w-100">
                    <div class="dropzone dz-clickable">
                        <div class="dz-default dz-message">
                            <button class="btn btn-link" style="text-decoration: none;"><i class="material-icons"></i> Add Product Images</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection