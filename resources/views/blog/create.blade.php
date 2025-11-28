<!-- Blog Create -->
@extends('layouts.master')

@section('content')
<div class="container mt-5 mb-4">
    <div class="d-flex align-items-center justify-content-between">
        <h2 class="mb-4">Create New Blog Post</h2>
        <a href="{{ route('blog.index') }}" class="btn btn-primary">Back to Posts</a>
    </div>
    <form method="POST" action="{{ route('blog.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
            @error('title')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="5" required>{{ old('description') }}</textarea>
            @error('description')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Select Category</label>
            <select name="category_id" id="category" class="form-control" required>
                <option value="" selected>Select Category...</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="thumbnail" class="form-label">Thumbnail</label>
            <input type="file" class="form-control" id="thumbnail" name="thumbnail" accept="image/*" required>
            @error('thumbnail')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary mb-5">Submit</button>
    </form>
</div>
@endsection