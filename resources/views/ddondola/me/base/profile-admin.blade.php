@extends('ddondola.me.base.account-admin')
@section('main')
    @include('ddondola.sections.banner')
    <div class="container py-4">
        <div class="row">
            <div class="col-md-3">
                @section('profile-info')
                    <user-info></user-info>
                @show
            </div>
            <div class="col-md-9">
                @yield('profile')
            </div>
        </div>
    </div>
@endsection
