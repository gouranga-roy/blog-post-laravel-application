<!-- Login Form -->
@extends('layouts.master')

@section('content')
    <div class="container d-flex flex-column justify-content-center align-items-center my-5" style="min-height: 60vh;">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="card p-4 shadow mb-4" style="width: 100%; max-width: 400px;">
            <h3 class="card-title text-center mb-4">Login</h3>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
                <p class="mt-3">Not have an account? <a href="{{ route('register.create') }}">Register here</a></p>
            </form>
        </div>

        <a class="btn btn-dark" href="{{ route('home') }}">Back To Home</a>
    </div>
@endsection
