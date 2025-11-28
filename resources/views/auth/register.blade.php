<!-- Registration Form -->
@extends('layouts.master') 
@section('content')
<div class="container d-flex flex-column justify-content-center align-items-center my-5" style="min-height: 60vh;">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="card p-4 shadow mb-4" style="width: 100%; max-width: 400px;">
        <h3 class="card-title text-center mb-4">Register</h3>
        <form action="{{ route('register.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="tel" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" required>
                @error('phone')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
                @error('password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Register</button>
            </div>
            <p class="mt-3">Already have an account? <a href="{{ route('login.create') }}">Login here</a></p>
        </form>
    </div>
    <a class="btn btn-dark" href="{{ route('home') }}">Back To Home</a>
</div>
@endsection