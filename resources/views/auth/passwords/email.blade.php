@extends('layouts.base.auth')
@section('title')@parent {{ __('Reset Password') }}@endsection
@section('auth-title') Reset your account password @endsection
@section('auth')
    <!--Reset Password Form-->
    <form name="Login_form" method="POST" action="{{ route('password.email') }}" aria-label="{{ __('Reset Password') }}">
        @csrf
        <div class="form-group">
            <label for="my-email">{{ __('E-Mail') }}</label>
            <div class="input-group">
                <div class="input-group input-group-seamless">
                    <span class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="material-icons">email</i>
                      </span>
                    </span>
                    <input class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" type="email" name="email" title="Enter Email" value="{{ old('email') }}"/>
                </div>
            </div>
            @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert" style="display: block;">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
        <button type="submit" class="btn_1 rounded full-width">{{ __('Send Password Reset Link') }}</button>
        <div class="text-center add_top_10">{{ __('Already Registered?') }} <strong><a href="{{ route('login') }}">{{ __('Login') }}</a></strong></div>
    </form>
    @endsection
