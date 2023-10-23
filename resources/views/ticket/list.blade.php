@php $user = auth()->user() @endphp

@extends('layouts.default')

<!-- Title Section -->
@section('title', 'Ticket List')

@push('style')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush

@section('content')

<div class="container mt-3 p-0" id="container2">
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if($user->role == 3)
    <a href="{{ route('ticket.create') }}"><button class="btn btn-info">Create</button></a>
    @endif
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="form-group m-2">
                    <label><strong>Status :</strong></label>
                    <select id='status' class="form-control" style="width: 200px">
                        <option value="">All</option>
                        <option value="0">Open</option>
                        <option value="1">Closed</option>
                    </select>
                </div>
                <div class="form-group m-2">
                    <label><strong>Priority :</strong></label>
                    <select id='priority' class="form-control" style="width: 200px">
                        <option value="">All</option>
                        <option value="0">Low</option>
                        <option value="1">High</option>
                    </select>
                </div>
                <div class="form-group m-2">
                    <label><strong>Category :</strong></label>
                    <select id='category' class="form-control" style="width: 200px">
                        <option value="">All</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                @if($user->role == 1)
                <div class="form-group m-2">
                    <label><strong>Assigned :</strong></label>
                    <select id='assigned' class="form-control" style="width: 200px">
                        <option value="">All</option>
                        <option value="1">Assigned</option>
                        <option value="0">Non-Assigned</option>
                    </select>
                </div>
                @endif
            </div>
            <button id="search" class="btn-sm btn-primary">search</button>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tickets:</h3>
        </div>
        <div class="col-12">
            <div class="card-body">
                <table id="ticket-table" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Ticket No.</th>
                            <th>Title</th>
                            <th>Date</th>
                            <th>Status</th>
                            @if($user->role == 1)
                            <th>Assigned</th>
                            @endif
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
    <script src="{{ asset('assets/js/ticketlist.js') }}"></script>
    @endpush