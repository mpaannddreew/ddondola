@extends('ddondola.me.base.profile-admin')
@section('title')@parent Change Password @endsection
@section('profile')
    <form method="post" action="{{ route('update.password') }}">
        @csrf
        <div class="card border border-radius mb-2">
            <div class="card-body p-4">
                @if (session('success'))
                    @include('layouts.sections.alert', ['class' => 'alert-success', 'message' => session('success')])
                @elseif (session('error'))
                    @include('layouts.sections.alert', ['class' => 'alert-error', 'message' => session('error')])
                @endif
                <div class="form-row">

                    <div class="form-group col-md-4">
                        <label for="old_password">Old Password</label>
                        <input name="old_password" type="password" class="form-control {{ $errors->has('old_password') ? ' is-invalid' : '' }}" id="old_password">
                        @if ($errors->has('old_password'))
                            <div class="invalid-feedback">{{ $errors->first('old_password') }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label for="new_password">New Password</label>
                        <input name="password" type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" id="password">
                        @if ($errors->has('password'))
                            <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label for="password_confirmation">Confirm Password</label>
                        <input name="password_confirmation" type="password" class="form-control {{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" id="password_confirmation">
                        @if ($errors->has('password_confirmation'))
                            <div class="invalid-feedback">{{ $errors->first('password_confirmation') }}</div>
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
@endsection
