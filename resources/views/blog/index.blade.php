@extends('layouts.master')
@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success mt-4">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger mt-4">
                {{ session('error') }}
            </div>
        @endif
        <div class="row">
            <div class="col-12 d-flex align-items-center justify-content-between mt-4">
                @if (Auth::guard('admin')->user()->user_roll === 'admin')
                    <a href="{{ route('category.index') }}" class="btn btn-primary mb-4">Manage Categories</a>
                @else
                    <a href="{{ route('home') }}" class="btn btn-primary mb-4">Back To Home</a>
                @endif
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
                            <th>Comments</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($allBlogs->count() > 0)
                            @foreach ($allBlogs as $blog)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="d-flex gap-3 align-items-center">
                                        <img src="{{ $blog->thumbnail }}" alt="{{ $blog->title }}" style="width: 80px; height: 80px; object-fit: cover;">
                                        <b style="max-width: 300px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $blog->title }}</b>
                                    </td>
                                    <td>{{ $blog->category->name }}</td>
                                    <td>{{ $blog->author->name }}</td>
                                    <td>{{ $blog->created_at->diffForHumans() }}</td>
                                    <td>
                                        @php

                                        @endphp
                                        <a href="{{ route('post.comment', $blog->slug) }}" class="btn btn-primary bgn-sm">View (<span>10</span>)</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('blog.show', $blog->slug) }}" class="btn btn-sm btn-success">View</a>
                                        <a href="{{ route('blog.edit', $blog->slug) }}" class="btn btn-sm btn-primary">Edit</a>
                                        <form action="{{ route('blog.destroy', $blog->slug) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this blog post?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="w-100 text-center" colspan="6"><b class="display-6 text-center">Post Not Found</b></td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
