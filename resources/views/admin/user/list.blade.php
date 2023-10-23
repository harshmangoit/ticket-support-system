@extends('layouts.default')

<!-- Title Section -->
@section('title', 'User List')

@push('style')

<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush

@section('content')
<div class="container mt-3 p-0" id="container2">
    @if (session('error'))
    <div class="alert alert-warning">
        {{ session('error') }}
    </div>
    @endif
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <a href="{{ route('user.create') }}"><button class="btn btn-info">Create</button></a>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="form-group m-2">
                    <label><strong>Status :</strong></label>
                    <select id='status' class="form-control" style="width: 200px">
                        <option value="">All</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
                <div class="form-group m-2">
                    <label><strong>Role :</strong></label>
                    <select id='role' class="form-control" style="width: 200px">
                        <option value="">All</option>
                        <option value="3">Regular User</option>
                        <option value="2">Agent</option>
                        <option value="1">Admin</option>
                    </select>
                </div>
            </div>
            <button id="search" class="btn-sm btn-primary">search</button>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">User List:</h3>
        </div>
        <div class="col-12">
            <div class="card-body">
                <table id="user-table" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @endsection

    @push('scripts')
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/js/userlist.js') }}"></script>
    @endpush