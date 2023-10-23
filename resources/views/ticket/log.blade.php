@extends('layouts.default')

@push('style')
@endpush

@section('title', 'Ticket Logs')

@section('content')

<div class="container">

    <!-- Timeline -->

    <!-- Main content -->
    <section class="content mt-3">
        <div class="container-fluid">
            <!-- Timelime example  -->
            <div class="row">
                <div class="col-md-12">
                    <!-- The time line -->
                    <div class="timeline">
                        <!-- timeline time label -->
                        <div class="time-label">
                            <span class="bg-blue">Logs of Ticket no: {{ $ticket->ticket_no }}</span>
                        </div>
                        @foreach($ticket->logs as $log)
                        <div>
                            <i class="fas fa-user bg-green"></i>
                            <div class="timeline-item">
                                <span class="time"><i class="fas fa-clock"></i> {{ $log->created_at->format('j M y - g:i A') }}</span>
                                <h3 class="timeline-header no-border"><a href="#">{{ $log->user->name }}</a> {{ $log->action }}</h3>
                            </div>
                        </div>
                        @endforeach
                        <div>
                            <i class="fas fa-clock bg-gray"></i>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
            </div>
        </div>
        <!-- /.timeline -->
    </section>
    <!-- /.content -->

    <a href="{{ route('ticket.index') }}"><button class="btn btn-secondary"> Back </button></a>
</div>

@endsection

@push('script')
@endpush