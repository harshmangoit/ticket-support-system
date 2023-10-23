@extends('layouts.default')

@section('title', 'Ticket Edit')

@push('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/fancybox/jquery.fancybox-1.3.4.css' )}}" media="screen" />
<link rel="stylesheet" href="{{ asset('assets/style.css' )}}" />
@endpush

@section('content')

@php $user = auth()->user() @endphp

<div class="container mt-3 p-0">

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit Ticket : {{ $ticket->ticket_no }}</h3>
        </div>
        <form id="ticketForm" action="{{ route('ticket.update', $ticket->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
                <input type="hidden" class="form-control" name="user_id" value="{{ $user->id }}">

                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" placeholder="Enter ticket title" value="{{ $ticket->title }}">
                    @error('title')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="category">Category:</label>
                    <select class="form-control @error('category') is-invalid @enderror" id="category" name="category">
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" @if($ticket->category->id == $category->id) selected @endif>{{$category->name}}</option>
                        @endforeach
                    </select>
                    @error('category')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="detail">Detail:</label>
                    <textarea class="form-control @error('detail') is-invalid @enderror" id="detail" name="detail" placeholder="Enter ticket detail">{{ $ticket->detail }}</textarea>
                    @error('detail')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="images">Images:</label>
                    @foreach($ticket->images as $image)
                    <a id="example1" href="{{ asset($image->image) }}"><img src="{{ asset($image->image) }}" class="mr-3" alt="img" style="width:100px"></a>
                    @endforeach
                </div>

                <div class="form-group">
                    <label class="form-label @error('priority') is-invalid @enderror">Priority:</label>
                    <div class="form-check">
                        <input class="form-check-input @error('priority') is-invalid @enderror" type="radio" name="priority" id="low" value="0" {{ $ticket->priority == 0 ? 'checked' : '' }}>
                        <label class="form-check-label" for="low">
                            Low
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input @error('priority') is-invalid @enderror" type="radio" name="priority" id="high" value="1" {{ $ticket->priority == 1 ? 'checked' : '' }}>
                        <label class="form-check-label" for="high">
                            High
                        </label>
                    </div>
                    @error('priority')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="agent">Agent:</label>
                    <select class="form-control @error('agent') is-invalid @enderror" id="agent" name="agent">
                        <option value="">Select</option>
                        @foreach($agents as $agent)
                        <option value="{{ $agent->id }}" @if($ticket->agent_id == $agent->id) selected @endif>{{$agent->name}}</option>
                        @endforeach
                    </select>
                    @error('agent')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a class="btn btn-secondary" href="{{ route('ticket.index') }}">Back</a>
            </div>
        </form>
    </div>

</div>
@endsection

@push('scripts')
<script src="{{ asset('assets/js/ticketvalidate.js') }}"></script>
<script src="{{ asset('../../plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('../../plugins/jquery-validation/jquery.validate.min.js') }}"></script>

<!-- jquery-fancybox -->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<script type="text/javascript" src="{{ asset('assets/js/fancybox.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/fancybox/jquery.mousewheel-3.0.4.pack.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/fancybox/jquery.fancybox-1.3.4.pack.js') }}"></script>
@endpush