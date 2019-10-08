@extends('shoppie::shop.product.admin.base.edit')
@section('title')@parent Info @endsection
@section('edit-product-active', 'active')
@section('main')
    <div class="container py-2">
        <div class="row">
            <div class="col-md-8 offset-2">
                <form method="post" action="{{ route('product.update', ['product' => $product]) }}">
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
                                        <input type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" id="name" name="name" value="{{ $product->name }}">
                                        @if ($errors->has('name'))
                                            <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="category">Category</label>
                                        <select id="category" class="form-control form-control-md custom-select custom-select-md {{ $errors->has('category') ? ' is-invalid' : '' }}" name="category">
                                            <option></option>
                                            @foreach($product->shop->categories as $category)
                                                <optgroup label="{{ $category->name }}">{{ $category->name }}</optgroup>
                                                @foreach($category->categories as $subcategory)
                                                    <option value="{{ $subcategory->id }}" @if($subcategory->is($product->subcategory)) selected @endif>{{ $subcategory->name }}</option>
                                                @endforeach
                                            @endforeach
                                        </select>
                                        @if ($errors->has('category'))
                                            <div class="invalid-feedback">{{ $errors->first('category') }}</div>
                                        @endif
                                    </div>
                                    @if($product->shop->brandCount())
                                    <div class="form-group col-md-12">
                                        <label for="brand">Brand (Optional)</label>
                                        <select id="brand" class="form-control form-control-md custom-select custom-select-md {{ $errors->has('brand') ? ' is-invalid' : '' }}" name="brand">
                                            <option></option>
                                            @foreach($product->shop->brands as $brand)
                                                <option value="{{ $brand->id }}" @if($brand->is($product->brand)) selected @endif>{{ $brand->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('brand'))
                                            <div class="invalid-feedback">{{ $errors->first('brand') }}</div>
                                        @endif
                                    </div>
                                    @endif
                                    <div class="form-group col-md-12">
                                        <label for="price">Price</label>
                                        <input type="text" class="form-control {{ $errors->has('price') ? ' is-invalid' : '' }}" id="price" name="price" placeholder="{{ $product->currencyCode() }}" value="{{ $product->price }}">
                                        @if ($errors->has('price'))
                                            <div class="invalid-feedback">{{ $errors->first('price') }}</div>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="description">Description</label>
                                        <textarea style="min-height: 87px;" id="description" class="form-control {{ $errors->has('description') ? ' is-invalid' : '' }}" name="description">{{ $product->description }}</textarea>
                                        @if ($errors->has('description'))
                                            <div class="invalid-feedback">{{ $errors->first('description') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <product-attributes class="mb-2" old-attributes="{{ json_encode($product->settings('attributes')) }}"></product-attributes>
                        <div class="form-wizard-buttons text-md-right">
                            <button type="submit" class="btn btn-lg btn-pill btn-outline-primary">
                                <i class="material-icons">check</i> Update
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection