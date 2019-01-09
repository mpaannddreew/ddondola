@extends('layouts.base.auth')
@section('title')@parent {{ __('Reset Password') }}@endsection
@section('auth-title') {{ __('Reset your account password') }} @endsection
@section('auth')
    <form method="POST" action="{{ route('password.request') }}" aria-label="{{ __('Reset Password') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="my-email" class="sr-only">{{ __('E-Mail Address') }}</label>
            <input class="form-control" type="email" name="email" title="Enter Email" value="{{ old('email') }}"/>
            <i class="fa fa-envelope"></i>
            @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="my-password">{{ __('Password') }}</label>
            <input class="form-control" type="password" name="password" title="Enter password"/>
            <i class="fa fa-key"></i>
            @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
            <label for="password-confirm">{{ __('Confirm Password') }}</label>
            <input id="password-confirm" class="form-control" type="password" name="password_confirmation" title="Enter password"/>
            <i class="fa fa-key"></i>
            @if ($errors->has('password_confirmation'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                </span>
            @endif
        </div>

        <button type="submit" class="btn_1 rounded full-width">{{ __('Reset Password') }}</button>
        <div class="text-center add_top_10">{{ __('Already Registered?') }} <strong><a href="{{ route('login') }}">{{ __('Login') }}</a></strong></div>
    </form>
@endsection