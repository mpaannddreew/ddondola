@extends('layouts.base.auth')
@section('title')@parent {{ __('Reset Password') }}@endsection
@section('auth-title') {{ __('Reset your account password') }} @endsection
@section('auth')
    <form method="POST" action="{{ route('password.request') }}" aria-label="{{ __('Reset Password') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="form-group">
            <label for="my-email" class="sr-only">{{ __('E-Mail Address') }}</label>
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

        <div class="form-group">
            <label for="my-password">{{ __('Password') }}</label>
            <div class="input-group">
                <div class="input-group input-group-seamless">
                    <span class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="material-icons">lock</i>
                      </span>
                    </span>
                    <input class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" name="password" title="Enter password"/>
                </div>
            </div>
            @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert" style="display: block;">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <label for="password-confirm">{{ __('Confirm Password') }}</label>
            <div class="input-group">
                <div class="input-group input-group-seamless">
                    <span class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="material-icons">lock</i>
                      </span>
                    </span>
                    <input id="password-confirm" class="form-control {{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" type="password" name="password_confirmation" title="Enter password"/>
                </div>
            </div>
            @if ($errors->has('password_confirmation'))
                <span class="invalid-feedback" role="alert" style="display: block;">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                </span>
            @endif
        </div>

        <button type="submit" class="btn_1 rounded full-width">{{ __('Reset Password') }}</button>
        <div class="text-center add_top_10">{{ __('Already Registered?') }} <strong><a href="{{ route('login') }}">{{ __('Login') }}</a></strong></div>
    </form>
@endsection