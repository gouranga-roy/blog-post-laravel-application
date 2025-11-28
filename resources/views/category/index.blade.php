@extends('layouts.master')
@section('content')
<div class="container">
    <div class="row">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <h2>All Categories</h2>
        <div class="col-12 mt-4 mb-2 d-flex justify-content-between align-items-center">
            <a href="{{ route('blog.index') }}" class="btn btn-primary mb-4">Back To Posts</a>
            <a href="{{ route('category.create') }}" class="btn btn-primary mb-4">Create Category</a>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <table class="table mb-5 border table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                   @foreach ($categories as $category)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->slug }}</td>
                        <td>{{ $category->created_at->diffForHumans() }}</td>
                        <td>
                            <a href="{{ route('category.edit', $category->slug) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('category.destroy', $category->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                   @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
