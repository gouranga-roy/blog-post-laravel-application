@extends('layouts.master')

@section('content')
<div class="container mb-5">
    <div class="row">
        <div class="col-12 d-flex align-items-center justify-content-between mb-4">
            @if(Auth::guard('admin')->check())
                <h1 class="mt-4 display-8">Welcome, <span class="text-primary">{{ Auth::guard('admin')->user()->name }}!</span></h1>
                <a class="btn btn-primary me-4" href="{{ route('blog.index') }}">Manage Blog</a>
            @endif
        </div>
    </div>

    <div class="row g-4">
        @foreach($allBlogs as $blog)
            <div class="col-md-4">
                <div class="card h-100">
                    <img style="height: 240px; object-fit:cover; object-position: top;" src="{{ asset($blog->thumbnail) }}" class="card-img-top" alt="{{ $blog->title }}">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $blog->title }}</h5>
                        <p class="card-text" style="height:40px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $blog->description }}</p>
                        <a href="#" class="btn btn-primary mt-auto">Read More</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection