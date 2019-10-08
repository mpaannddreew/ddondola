@extends('shoppie::shop.admin.base.edit')
@section('title')@parent Shop Information @endsection
@section('info-active', 'active')
@section('main')
    <div class="container py-2">
        <div class="row">
            <div class="col-md-8 offset-2">
                <form method="post" action="{{ route('my.shop.update', ['shop' => $shop]) }}">
                    @csrf
                    <div class="card mb-2 border border-radius">
                        <div class="card-body p-4">
                            @if (session('success'))
                                @include('layouts.sections.alert', ['class' => 'alert-success', 'message' => session('success')])
                            @endif
                            <div class="form-row mx-4">
                                <div class="col-lg-12">
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="category">Shop Category</label>
                                            <select class="form-control form-control-md custom-select custom-select-md {{ $errors->has('category') ? ' is-invalid' : '' }}"
                                                    id="category" name="category">
                                                <option></option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" @if($category->is($shop->category)) selected @endif>{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('category'))
                                                <div class="invalid-feedback">{{ $errors->first('category') }}</div>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" id="name" name="name" value="{{ $shop->name }}">
                                            @if ($errors->has('name'))
                                                <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="phone_number">Phone Number</label>
                                            <input type="text" class="form-control {{ $errors->has('phone_number') ? ' is-invalid' : '' }}" id="phone_number" name="phone_number" value="{{ $shop->profile('phone_number') }}">
                                            @if ($errors->has('phone_number'))
                                                <div class="invalid-feedback">{{ $errors->first('phone_number') }}</div>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" name="email" value="{{ $shop->profile('email') }}">
                                            @if ($errors->has('email'))
                                                <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="description">About</label>
                                            <textarea style="min-height: 87px;" id="about" name="about" class="form-control {{ $errors->has('about') ? ' is-invalid' : '' }}">{{ $shop->profile('about') }}</textarea>
                                            @if ($errors->has('about'))
                                                <div class="invalid-feedback">{{ $errors->first('about') }}</div>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="address">Address</label>
                                            <textarea style="min-height: 87px;" id="address" name="address" class="form-control {{ $errors->has('address') ? ' is-invalid' : '' }}">{{ $shop->profile('address') }}</textarea>
                                            @if ($errors->has('address'))
                                                <div class="invalid-feedback">{{ $errors->first('address') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-wizard-buttons text-md-right">
                        <button type="submit" class="btn btn-lg btn-pill btn-outline-primary">
                            <i class="material-icons">check</i> Update Shop
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection