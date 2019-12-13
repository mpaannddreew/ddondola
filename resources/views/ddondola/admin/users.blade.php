@extends('ddondola.admin.base.admin')
@section('title')@parent Users @endsection
@section('people-active', 'active')
@section('page-header')
    <div class="page-header row no-gutters py-4">
        <div class="col">
            <span class="text-uppercase page-subtitle"><i class="fa fa-folder"></i> Directory</span>
            <h3 class="page-title">Users</h3>
        </div>
    </div>
@endsection
@section('main')
    <div class="container py-2">
        <table id="users">
            <thead>
            <tr>
                <th>#</th>
                <th>Date</th>
                <th>Customer</th>
                <th>Products</th>
                <th>Status</th>
                <th>Total</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>1</td>
                <td>October 31st 2017 <span class="text-sm">02:10 PM</span>
                </td>
                <td>Mrs. Chauncey McDermott</td>
                <td>68010</td>
                <td>
                    <span class="text-warning">Pending</span>
                </td>
                <td>
                    <span class="text-success">$269.75</span>
                </td>
                <td>
                    <div class="btn-group btn-group-sm" role="group" aria-label="Table row actions">
                        <button type="button" class="btn btn-white">
                            <i class="material-icons">&#xE5CA;</i>
                        </button>
                        <button type="button" class="btn btn-white">
                            <i class="material-icons">&#xE870;</i>
                        </button>
                        <button type="button" class="btn btn-white">
                            <i class="material-icons">&#xE254;</i>
                        </button>
                        <button type="button" class="btn btn-white">
                            <i class="material-icons">&#xE872;</i>
                        </button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection
@section('javascripts')
    @parent
    <script>
        $("#users").DataTable({responsive: !0})
    </script>
@endsection