@extends('ddondola.me.base.account-admin')
@section('profile-base-active') active @endsection
@section('stylesheets')
    @parent
    <style>
        ul#profile.nav.nav-tabs.nav-justified.border-0.flex-column.flex-lg-row li.nav-item a.nav-link {
            margin: 0 !important;
        }

        ul#profile.nav.nav-tabs.nav-justified.border-0.flex-column.flex-lg-row  li.nav-item {
            border-right:1px solid #e1e5eb !important;
        }

        ul#profile.nav.nav-tabs.nav-justified.border-0.flex-column.flex-lg-row  li.nav-item:last-child {
            border-right: none !important;
        }
    </style>
@endsection
@section('main')
    @include('ddondola.sections.user')
@endsection
