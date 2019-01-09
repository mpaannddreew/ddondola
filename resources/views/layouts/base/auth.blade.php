@extends('layouts.out')
@section('body-id') id="login_bg" @endsection
@section('lp-register')
    <nav id="menu" class="fake_menu"></nav>

    <div id="login">
        <aside>
            <figure>
                @yield('auth-title')
            </figure>
            @yield('auth')
            <div class="copy">© 2018 {{ config('app.name', 'Ddondola') }}</div>
        </aside>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('auth/js/jquery.appear.min.js') }}"></script>
    <script src="{{ asset('auth/js/jquery.incremental-counter.js') }}"></script>
@endsection