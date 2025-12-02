@extends('layouts.master')
@section('content')
    <div class="container">
        @if (session('success'))
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
                        <h3>{{ $blog->title }}</h3>
                    </div>
                    <div class="card-body">
                        <img src="{{ asset($blog->thumbnail) }}" alt="{{ $blog->title }}" class="img-fluid mb-4" style="max-height: 400px; object-fit: cover;">
                        <div class="d-flex gap-3 flex-wrap mb-3">
                            <p><strong>Author:</strong> {{ $blog->author->name }}</p>
                            <p><strong>Category:</strong> {{ $blog->category->name }}</p>
                            <p><strong>Created At:</strong> {{ $blog->created_at->format('M j, Y, g:i a') }}</p>
                        </div>
                        <hr>
                        <div>{!! nl2br(e($blog->description)) !!}</div>
                        <h4 class="mt-4">Tags</h4>
                        <div class="tab my-4">
                            <a href="#" class="btn btn-sm btn-light">Post</a>
                            <a href="#" class="btn btn-sm btn-light">Related</a>
                        </div>
                        <hr class="my-4">
                        <h4 class="mb-4">All Comments</h4>
                        <div class="comment-items">
                            <ul style="margin:0;padding:0;list-style:none;">
                                <li>
                                    <div class="comment mb-4">
                                        <div class="d-flex gap-3">
                                            <figure>
                                                <img src="https://placehold.co/60x60?text=Author" alt="">
                                            </figure>
                                            <div class="comment-text">
                                                <h4>Author Name</h4>
                                                <span class="mb-3 d-block"><strong>Date:</strong> Nov 28, 2025</span>
                                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure, doloribus sed? Earum a iusto vitae deleniti pariatur qui tempore provident?</p>
                                            </div>
                                        </div>
                                    </div>
                                    <ol style="padding-left:80px;list-style: none;">
                                        <li>
                                            <div class="comment mb-4">
                                                <div class="d-flex gap-3">
                                                    <figure>
                                                        <img src="https://placehold.co/60x60?text=Author" alt="">
                                                    </figure>
                                                    <div class="comment-text">
                                                        <h4>Author Name</h4>
                                                        <span class="mb-3 d-block"><strong>Date:</strong> Nov 28, 2025</span>
                                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure, doloribus sed? Earum a iusto vitae deleniti pariatur qui tempore provident?</p>

                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ol>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
