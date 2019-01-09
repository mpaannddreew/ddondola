@extends('layouts.base.auth')
@section('title')@parent {{ __('Authorization') }}@endsection
@section('stylesheets')
    <style>
        .passport-authorize .scopes {
            margin-top: 20px;
        }

        .passport-authorize .buttons {
            margin-top: 25px;
            text-align: center;
        }

        .passport-authorize .btn {
            width: 125px;
        }

        .passport-authorize .btn-approve {
            margin-right: 15px;
        }

        .passport-authorize form {
            display: inline;
        }
    </style>
@endsection
@section('auth-title') {{ __('Authorization Request') }} @endsection
@section('auth')
    <div class="passport-authorize">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div>
                    <!-- Introduction -->
                    <p><strong>{{ $client->name }}</strong> is requesting permission to access your account.</p>

                    <!-- Scope List -->
                    @if (count($scopes) > 0)
                        <div class="scopes">
                            <p><strong>This application will be able to:</strong></p>

                            <ul>
                                @foreach ($scopes as $scope)
                                    <li>{{ $scope->description }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="buttons">
                        <!-- Authorize Button -->
                        <form method="post" action="{{ url('/oauth/authorize') }}">
                            {{ csrf_field() }}

                            <input type="hidden" name="state" value="{{ $request->state }}">
                            <input type="hidden" name="client_id" value="{{ $client->id }}">
                            <button type="submit" class="btn btn-success btn-approve">Authorize</button>
                        </form>

                        <!-- Cancel Button -->
                        <form method="post" action="{{ url('/oauth/authorize') }}">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}

                            <input type="hidden" name="state" value="{{ $request->state }}">
                            <input type="hidden" name="client_id" value="{{ $client->id }}">
                            <button class="btn btn-danger">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
