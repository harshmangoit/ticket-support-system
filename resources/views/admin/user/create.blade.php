@extends('layouts.default')

<!-- Title Section -->
@section('title', 'Admin | User Create')

@push('style')

@endpush

@section('content')

<div class="container mt-3 p-0">

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Create user</h3>
        </div>
        <form id="userForm" action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="name" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Enter name" address value="{{ old('name') }}">
                    @error('name')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Enter email address" value="{{ old('email') }}">
                    @error('email')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Enter password here" value="{{ old('password') }}">
                    @error('password')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="confirmPassword">Confirm Password:</label>
                    <input type="password" class="form-control @error('confirmPassword') is-invalid @enderror" name="confirmPassword" id="confirmPassword" placeholder="Enter confirm password" value="{{ old('confirmPassword') }}">
                    @error('confirmPassword')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label @error('role') is-invalid @enderror">Role:</label>
                    <div class="form-check">
                        <input class="form-check-input @error('role') is-invalid @enderror" type="radio" name="role" id="user" value="3" {{ old('role') === '3' ? 'checked' : '' }}>
                        <label class="form-check-label" for="user">
                            Regular User
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input @error('role') is-invalid @enderror" type="radio" name="role" id="agent" value="2" {{ old('role') === '2' ? 'checked' : '' }}>
                        <label class="form-check-label" for="agent">
                            Agent
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input @error('role') is-invalid @enderror" type="radio" name="role" id="admin" value="1" {{ old('role') === '1' ? 'checked' : '' }}>
                        <label class="form-check-label" for="admin">
                            Admin
                        </label>
                    </div>
                    @error('role')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label @error('status') is-invalid @enderror">Status:</label>
                    <div class="form-check">
                        <input class="form-check-input @error('status') is-invalid @enderror" type="radio" name="status" id="active" value="1" {{ old('status') === '1' ? 'checked' : '' }}>
                        <label class="form-check-label" for="active">
                            Active
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input @error('status') is-invalid @enderror" type="radio" name="status" id="inactive" value="0" {{ old('status') === '0' ? 'checked' : '' }}>
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
                <button type="submit" class="btn btn-primary">Submit</button>
                <a class="btn btn-secondary" href="{{route('user.index')}}">Back</a>
            </div>
        </form>
    </div>
</div> 
@endsection @push('scripts') 
<script src="{{ asset('assets/js/uservalidate.js') }}"></script>
<script src="{{ asset('../../plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('../../plugins/jquery-validation/jquery.validate.min.js') }}">
</script>
@endpush