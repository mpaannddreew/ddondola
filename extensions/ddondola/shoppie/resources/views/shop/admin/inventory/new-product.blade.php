@extends('shoppie::shop.admin.inventory.base')
@section('title')@parent New Product @endsection
@section('new-product-active', 'active')
@section('main')
    <div class="container py-2">
        <div class="row">
            <div class="col-md-8 offset-2">
                @if(!$shop->brands()->count() || !$shop->categories()->count() || !$shop->subcategories()->count())
                    <div class="card card-small border">
                        <div class="card-body">
                            <div align="center">
                                <h4 class="m-0"><i class="material-icons">error</i></h4>
                                <p class="mb-3">
                                    You have not added any @if(!$shop->brands()->count()) brands @elseif(!$shop->categories()->count()) categories @elseif(!$shop->subcategories()->count()) subcategories @endif yet!
                                </p>
                                <a href="@if(!$shop->brands()->count()) {{ route('my.shop.brands', ['shop' => $shop]) }} @elseif(!$shop->categories()->count()) {{ route('my.shop.categories', ['shop' => $shop]) }} @elseif(!$shop->subcategories()->count()) {{ route('my.shop.sub-categories', ['shop' => $shop]) }} @endif" class="btn btn-success btn-pill">
                                    <i class="fa fa-plus"></i>
                                    Add @if(!$shop->brands()->count()) brands @elseif(!$shop->categories()->count()) categories @elseif(!$shop->subcategories()->count()) subcategories @endif
                                </a>
                            </div>
                        </div>
                    </div>
                @else
                    <form method="post" action="{{ route('my.shop.inventory.save-product', ['shop' => $shop]) }}">
                        @csrf
                        <div class="checkout-process">
                            <div class="card mb-2">
                                <div class="card-header form-wizard-step border-right border-top border-top-right-radius-0">
                                    <h5>
                                        <a class="btn btn-link" href="javascript:void(0)">
                                            <span><i class="material-icons">more_vert</i></span>
                                            <i class="material-icons">info</i> General Information
                                        </a>
                                    </h5>
                                </div>
                                <div class="card-body p-4 border border-top-0">
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" id="name" name="name" value="{{ old('name') }}">
                                            @if ($errors->has('name'))
                                                <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="category">Category</label>
                                            <select id="category" class="form-control form-control-md custom-select custom-select-md {{ $errors->has('category') ? ' is-invalid' : '' }}" name="category">
                                                <option></option>
                                                @foreach($shop->categories as $category)
                                                    <optgroup label="{{ $category->name }}">{{ $category->name }}</optgroup>
                                                    @foreach($category->categories as $subcategory)
                                                        <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                                                    @endforeach
                                                @endforeach
                                            </select>
                                            @if ($errors->has('category'))
                                                <div class="invalid-feedback">{{ $errors->first('category') }}</div>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="brand">Brand</label>
                                            <select id="brand" class="form-control form-control-md custom-select custom-select-md {{ $errors->has('brand') ? ' is-invalid' : '' }}" name="brand">
                                                <option></option>
                                                @foreach($shop->brands as $brand)
                                                    <option value="{{ $brand->id }}" @if($brand->is($brand->brand)) selected @endif>{{ $brand->name }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('brand'))
                                                <div class="invalid-feedback">{{ $errors->first('brand') }}</div>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="price">Price</label>
                                            <input type="text" class="form-control {{ $errors->has('price') ? ' is-invalid' : '' }}" id="price" name="price" placeholder="{{ $shop->currencyCode() }}" value="{{ old('price') }}">
                                            @if ($errors->has('price'))
                                                <div class="invalid-feedback">{{ $errors->first('price') }}</div>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="description">Description</label>
                                            <textarea style="min-height: 87px;" id="description" class="form-control {{ $errors->has('description') ? ' is-invalid' : '' }}" name="description">{{ old('description') }}</textarea>
                                            @if ($errors->has('description'))
                                                <div class="invalid-feedback">{{ $errors->first('description') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <product-attributes class="mb-2" old-attributes="{{ old('attributes') }}"></product-attributes>
                            <div class="card mb-2">
                                <div class="card-header form-wizard-step border-right border-top border-top-right-radius-0">
                                    <h5>
                                        <a class="btn btn-link" href="javascript:void(0)">
                                            <span><i class="material-icons">more_vert</i></span>
                                            <i class="material-icons">label_outline</i> Stock Information
                                        </a>
                                    </h5>
                                </div>
                                <div class="card-body p-4 border border-top-0">
                                    <div class="form-row">
                                        <div class="col-lg-12">
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label for="quantity">Quantity</label>
                                                    <input type="text" class="form-control {{ $errors->has('quantity') ? ' is-invalid' : '' }}" id="quantity" name="quantity">
                                                    @if ($errors->has('quantity'))
                                                        <div class="invalid-feedback">{{ $errors->first('quantity') }}</div>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="description">Note</label>
                                                    <textarea style="min-height: 87px;" id="note" class="form-control {{ $errors->has('note') ? ' is-invalid' : '' }}" name="note">{{ old('note') }}</textarea>
                                                    @if ($errors->has('note'))
                                                        <div class="invalid-feedback">{{ $errors->first('note') }}</div>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="minimum_stock">Notify Below Quantity</label>
                                                    <input type="text" class="form-control {{ $errors->has('minimum_stock') ? ' is-invalid' : '' }}" id="minimum_stock" name="minimum_stock" value="{{ old('minimum_stock') }}">
                                                    @if ($errors->has('minimum_stock'))
                                                        <div class="invalid-feedback">{{ $errors->first('minimum_stock') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <product-image-manager></product-image-manager>
                            <div class="form-wizard-buttons text-md-right">
                                <button type="submit" class="btn btn-lg btn-pill btn-outline-primary">
                                    <i class="material-icons">check</i> Save
                                </button>
                            </div>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection