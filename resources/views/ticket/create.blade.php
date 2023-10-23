@extends('layouts.default')

<!-- Title Section -->
@section('title', 'Admin | Dashboard')

@push('style')

@endpush

@section('content')

@php $user = auth()->user() @endphp

<div class="container mt-3 p-0">
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Create Ticket</h3>
        </div>
        <form id="ticketForm" action="{{ route('ticket.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <input type="hidden" class="form-control" name="user_id" value="{{ $user->id }}">

                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" placeholder="Enter ticket title" value="{{ old('title') }}">
                    @error('title')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="category">Category:</label>
                    <select class="form-control @error('category') is-invalid @enderror" id="category" name="category">
                        <option value="">Select</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{$category->name}}</option>
                        @endforeach
                    </select>
                    @error('category')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="detail">Detail:</label>
                    <textarea class="form-control @error('detail') is-invalid @enderror" id="detail" name="detail" placeholder="Enter ticket detail">{{ old('detail') }}</textarea>
                    @error('detail')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="images">Images:</label>
                    <input type="file" class="@error('images.*') is-invalid @enderror" id="images" name="images[]" multiple>
                    @error('images.*')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label @error('priority') is-invalid @enderror">Priority:</label>
                    <div class="form-check">
                        <input class="form-check-input @error('priority') is-invalid @enderror" type="radio" name="priority" id="low" value="0" {{ old('priority') == 0 ? 'checked' : '' }}>
                        <label class="form-check-label" for="low">
                            Low
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input @error('priority') is-invalid @enderror" type="radio" name="priority" id="high" value="1" {{ old('priority') == 1 ? 'checked' : '' }}>
                        <label class="form-check-label" for="high">
                            High
                        </label>
                    </div>
                    @error('priority')
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
@endpush