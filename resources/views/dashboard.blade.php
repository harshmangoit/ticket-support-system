@extends('layouts.default')

<!-- Title Section -->
@section('title', 'Dashboard')

@push('style')

@endpush

@section('content')

@php
$data = $ticketData();
$user = auth()->user();
@endphp

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $data['totalTickets'] }}</h3>

                    <p>Total Tickets</p>
                </div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $data['openTickets'] }}</h3>

                    <p>Open Tickets</p>
                </div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $data['closedTickets'] }}</h3>

                    <p>Closed Tickets</p>
                </div>
            </div>
        </div>
        <!-- ./col -->
        @if ($user->role == '1')
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $data['notAssigned'] }}</h3>

                    <p>Not Assigned</p>
                </div>
            </div>
        </div>
        @endif
        <!-- ./col -->
    </div>
    <!-- /.row -->
</div>

{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
</h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                {{ __("You're logged in!") }}
            </div>
        </div>
    </div>
</div>
</x-app-layout> --}}
@endsection

@push('scripts')

@endpush