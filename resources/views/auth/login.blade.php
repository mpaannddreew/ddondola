@extends('layouts.base.auth')
@section('title')@parent {{ __('Login') }}@endsection
@section('auth-title') {{ __('Login to your account') }} @endsection
@section('auth')
    <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
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

        <div class="clearfix add_bottom_30">
            <div class="checkboxes float-left">
                <label class="container_check">{{ __('Remember Me') }}
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    <span class="checkmark"></span>
                </label>
            </div>
            <div class="float-right mt-1">
                <a id="forgot" href="{{ route('password.request') }}">Forgot Password?</a>
            </div>
        </div>
        <button type="submit" class="btn_1 rounded full-width">{{ __('Login') }}</button>
        <div class="text-center add_top_10">New to {{ config('app.name') }}? <strong><a href="{{ route('register') }}">{{ __('Sign up!') }}</a></strong></div>
    </form>
    @endsection
