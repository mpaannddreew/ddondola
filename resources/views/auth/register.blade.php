@extends('layouts.base.auth')
@section('title')@parent {{ __('Register') }}@endsection
@section('auth-title') {{ __('Create a new account') }}@endsection
@section('auth')
    <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
        @csrf
        <div class="form-group {{ $errors->has('first_name') ? ' has-error' : '' }}">
            <label for="first_name">{{ __('First name') }}</label>
            <input class="form-control" value="{{ old('first_name') }}" type="text" name="first_name" title="Enter first name"/>
            <i class="fa fa-user"></i>
            @if ($errors->has('first_name'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('first_name') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group {{ $errors->has('last_name') ? ' has-error' : '' }}">
            <label for="last_name">{{ __('Last name') }}</label>
            <input class="form-control" value="{{ old('last_name') }}" type="text" name="last_name" title="Enter last name"/>
            <i class="fa fa-user"></i>
            @if ($errors->has('last_name'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('last_name') }}</strong>
                </span>
            @endif
        </div>
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
        <button type="submit" class="btn_1 rounded full-width">{{ __('Register') }}</button>
        <div class="text-center add_top_10">{{ __('Already Registered?') }} <strong><a href="{{ route('login') }}">{{ __('Login') }}</a></strong></div>
    </form>
@endsection
