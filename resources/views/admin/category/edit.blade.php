@extends('layouts.default')

<!-- Title Section -->
@section('title', 'Admin | Dashboard')

@push('style')

@endpush

@section('content')

<div class="container mt-3 p-0">
    
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit Category</h3>
        </div>
        <form id="categoryForm" action="{{ route('category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Category Name:</label>
                    <input type="name" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Enter category name" value="{{ $category->name }}">
                    @error('name')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label @error('status') is-invalid @enderror">Status:</label>
                    <div class="form-check">
                        <input class="form-check-input @error('status') is-invalid @enderror" type="radio" name="status" id="active" value="1" {{ $category->status == 1 ? 'checked' : '' }}>
                        <label class="form-check-label" for="active">
                            Active
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="inactive" value="0" {{ $category->status == 0 ? 'checked' : '' }}>
                        <label class="form-check-label" for="inactive">
                            Inactive
                        </label>
                    </div>
                    @error('status')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update</button>
                <a class="btn btn-secondary" href="{{route('category.index')}}">Back</a>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script src="{{ asset('assets/js/categoryvalidate.js') }}"></script>
<script src="{{ asset('../../plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('../../plugins/jquery-validation/jquery.validate.min.js') }}"></script>
@endpush