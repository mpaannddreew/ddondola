@extends('layouts.base.auth')
@section('title')@parent {{ __('Reset Password') }}@endsection
@section('auth-title') Reset your account password @endsection
@section('auth')
    <!--Reset Password Form-->
    <form name="Login_form" method="POST" action="{{ route('password.email') }}" aria-label="{{ __('Reset Password') }}">
        @csrf
        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="my-email">{{ __('E-Mail Address') }}</label>
            <input class="form-control" type="email" name="email" title="Enter Email" value="{{ old('email') }}"/>
            <i class="fa fa-envelope"></i>
            @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
        <button type="submit" class="btn_1 rounded full-width">{{ __('Send Password Reset Link') }}</button>
        <div class="text-center add_top_10">{{ __('Already Registered?') }} <strong><a href="{{ route('login') }}">{{ __('Login') }}</a></strong></div>
    </form>
    @endsection
