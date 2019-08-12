@extends('ddondola.me.base.edit')
@section('title')@parent Profile Information @endsection
@section('info-active', 'active')
@section('main')
    <div class="container py-2">
        <div class="row">
            <div class="col-md-8 offset-2">
                <form method="post" action="{{ route('my.profile.update') }}">
                    @csrf
                    <div class="card border border-radius mb-2">
                        <div class="card-body p-4">
                            @if (session('success'))
                                @include('layouts.sections.alert', ['class' => 'alert-success', 'message' => session('success')])
                            @endif
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="first_name">First Name</label>
                                    <input name="first_name" type="text" class="form-control {{ $errors->has('first_name') ? ' is-invalid' : '' }}" id="first_name" value="{{ $user->first_name }}">
                                    @if ($errors->has('first_name'))
                                        <div class="invalid-feedback">{{ $errors->first('first_name') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="last_name">Last Name</label>
                                    <input name="last_name" type="text" class="form-control {{ $errors->has('last_name') ? ' is-invalid' : '' }}" id="last_name" value="{{ $user->last_name }}">
                                    @if ($errors->has('last_name'))
                                        <div class="invalid-feedback">{{ $errors->first('last_name') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="email">Email</label>
                                    <input disabled name="email" type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" value="{{ $user->email }}">
                                    @if ($errors->has('email'))
                                        <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="phone_number">Phone Number</label>
                                    <input name="phone_number" type="text" class="form-control {{ $errors->has('phone_number') ? ' is-invalid' : '' }}" id="phone_number" value="{{ $user->profile('phone_number') }}">
                                    @if ($errors->has('phone_number'))
                                        <div class="invalid-feedback">{{ $errors->first('phone_number') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="about">About</label>
                                    <textarea name="about" class="form-control {{ $errors->has('about') ? ' is-invalid' : '' }}" id="about">{{ $user->profile('about') }}</textarea>
                                    @if ($errors->has('about'))
                                        <div class="invalid-feedback">{{ $errors->first('about') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="address">Address</label>
                                    <textarea name="address" class="form-control {{ $errors->has('address') ? ' is-invalid' : '' }}" id="address">{{ $user->profile('address') }}</textarea>
                                    @if ($errors->has('address'))
                                        <div class="invalid-feedback">{{ $errors->first('address') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-wizard-buttons text-md-right">
                        <button type="submit" class="btn btn-lg btn-pill btn-outline-primary">
                            <i class="material-icons">check</i> Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
