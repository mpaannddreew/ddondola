@extends('layouts.base.auth')
@section('title')@parent {{ __('Register') }}@endsection
@section('auth-title') {{ __('Create a new account') }}@endsection
@section('auth')
    <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
        @csrf
        <div class="form-group">
            <label for="first_name">{{ __('First name') }}</label>
            <div class="input-group">
                <div class="input-group input-group-seamless">
                    <span class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="material-icons">person</i>
                      </span>
                    </span>
                    <input class="form-control {{ $errors->has('first_name') ? ' is-invalid' : '' }}" value="{{ old('first_name') }}" type="text" name="first_name" title="Enter first name"/>
                </div>
            </div>
            @if ($errors->has('first_name'))
                <span class="invalid-feedback" role="alert" style="display: block;">
                    <strong>{{ $errors->first('first_name') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <label for="last_name">{{ __('Last name') }}</label>
            <div class="input-group">
                <div class="input-group input-group-seamless">
                    <span class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="material-icons">person</i>
                      </span>
                    </span>
                    <input class="form-control {{ $errors->has('last_name') ? ' is-invalid' : '' }}" value="{{ old('last_name') }}" type="text" name="last_name" title="Enter last name"/>
                </div>
            </div>
            @if ($errors->has('last_name'))
                <span class="invalid-feedback" role="alert" style="display: block;">
                    <strong>{{ $errors->first('last_name') }}</strong>
                </span>
            @endif
        </div>
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
        <button type="submit" class="btn_1 rounded full-width">{{ __('Register') }}</button>
        <div class="text-center add_top_10">{{ __('Already Registered?') }} <strong><a href="{{ route('login') }}">{{ __('Login') }}</a></strong></div>
    </form>
@endsection
