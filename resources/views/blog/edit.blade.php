@extends('layouts.master')
@section('content')
<div class="container">
    @if(session('success'))
        <div class="alert alert-success mt-4">
            {{ session('success') }}
        </div>
    @endif
    <div class="row">
        <div class="col-8 offset-2 d-flex align-items-center justify-content-between mt-4">
            <a href="{{ route('blog.index') }}" class="btn btn-primary mb-4">Back To Posts</a>
        </div>
    </div>
    <div class="row">
        <div class="col-8 offset-2">
            <div class="card mb-5">
                <div class="card-header">
                    <h3>Edit Post</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('blog.update', $blog->slug) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $blog->title) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="5" required>{{ old('description', $blog->description) }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Category</label>
                            <select class="form-select" id="category_id" name="category_id" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ (old('category_id', $blog->category_id) == $category->id) ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="thumbnail" class="form-label">Thumbnail</label>
                            <input type="file" class="form-control" id="thumbnail" name="thumbnail">
                            @if($blog->thumbnail)
                                <img src="{{ asset($blog->thumbnail) }}" alt="{{ $blog->title }}" class="img-fluid mt-2" style="max-height: 150px; object-fit: cover;">
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary">Update Post</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection