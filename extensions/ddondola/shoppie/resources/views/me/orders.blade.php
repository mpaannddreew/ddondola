@extends('ddondola.me.base.account-admin-icon-side-nav')
@section('title')@parent Orders @endsection
@section('orders-active', 'active')
@section('main')
    <my-order-directory></my-order-directory>
@endsection
@section('scripts')
    @parent
    <script src="https://api.ravepay.co/flwv3-pug/getpaidx/api/flwpbf-inline.js" type="application/javascript"></script>
@endsection