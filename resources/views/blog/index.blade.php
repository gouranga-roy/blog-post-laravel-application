@extends('layouts.master')
@section('content')
<div class="container">
    @if(session('success'))
        <div class="alert alert-success mt-4">
            {{ session('success') }}
        </div>
    @endif
    <div class="row">
        <div class="col-12 d-flex align-items-center justify-content-between mt-4">
            <a href="{{ route('category.index') }}" class="btn btn-primary mb-4">All Categories</a>
            <a href="{{ route('blog.create') }}" class="btn btn-primary mb-4">Create New Post</a>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <table class="table mb-5 border align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Thumbnail & Title</th>
                        <th>Category</th>
                        <th>Author</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($allBlogs as $blog)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="d-flex gap-3 align-items-center">
                            <img src="{{ asset($blog->thumbnail) }}" alt="{{ $blog->title }}" style="width: 80px; height: 80px; object-fit: cover;">
                            <b style="max-width: 300px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $blog->title }}</b>
                        </td>
                        <td>{{ $blog->category->name }}</td>
                        <td>{{ $blog->author->name }}</td>
                        <td>{{ $blog->created_at->diffForHumans() }}</td>
                        <td>
                            <a href="#" class="btn btn-sm btn-success">View</a>
                            <a href="#" class="btn btn-sm btn-primary">Edit</a>
                            <a href="#" class="btn btn-sm btn-danger">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
