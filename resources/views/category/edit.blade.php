@extends('layouts.master')
@section('content')
<hr>
<div class="container mb-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h2 class="mb-4">Edit Category</h2>
                <a href="{{ route('category.index') }}" class="btn btn-primary ms-auto">Back to Categories</a>
            </div>
            <form action="{{ route('category.update', $category->slug) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group mb-3">
                    <label for="name" class="form-label">Category Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $category->name) }}" required>
                    @error('name')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror 
                </div>
                <div class="form-group mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="4">{{ old('description', $category->description) }}</textarea>
                    @error('description')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror 
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection