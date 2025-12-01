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
                <a href="{{ route('home') }}" class="btn btn-primary mb-4">Back To Posts</a>
            </div>
        </div>
        <div class="row">
            <div class="col-8 offset-2">
                <div class="card mb-5">
                    <div class="card-header">
                        <h3>{{ $blogSingle->title }}</h3>
                    </div>
                    <div class="card-body">
                        <img src="{{ asset($blogSingle->thumbnail) }}" alt="{{ $blogSingle->title }}" class="img-fluid mb-4" style="max-height: 400px; object-fit: cover;">
                        <div class="d-flex gap-3 flex-wrap mb-3">
                            <p><strong>Author:</strong> {{ $blogSingle->author->name }}</p>
                            <p><strong>Category:</strong> <button class="btn btn-sm btn-light">{{ $blogSingle->category->name }}</button></p>
                            <p><strong>Created At:</strong> {{ $blogSingle->created_at->format('M j, Y') }}</p>
                            <p><strong>Comments:</strong> 10</p>
                        </div>
                        <hr>
                        <div>{!! nl2br(e($blogSingle->description)) !!}</div>
                        <h4 class="mt-4">Tags</h4>
                        <div class="tab my-4">
                            <a href="#" class="btn btn-sm btn-light">Post</a>
                            <a href="#" class="btn btn-sm btn-light">Related</a>
                        </div>
                        <hr class="my-4">
                        <h4 class="mb-4">All Comments</h4>
                        <div class="comment-items">
                            <ul style="margin:0;padding:0;list-style:none;">
                                @if ($blogSingle->comments->count() > 0)
                                    @foreach ($blogSingle->comments as $blogComment)
                                        <li>
                                            <div class="comment mb-4">
                                                <div class="d-flex gap-3">
                                                    <figure>
                                                        <img src="https://placehold.co/60x60?text={{ $blogComment->user_name }}" alt="">
                                                    </figure>
                                                    <div class="comment-text">
                                                        <h5>{{ $blogComment->user_name }}</h5>
                                                        <span class="mb-3 d-block"><strong>Date:</strong> {{ $blogComment->created_at->format('M j, Y') }}</span>
                                                        <p>{{ $blogComment->comment }}</p>
                                                        <div class="dropdown">
                                                            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                Reply
                                                            </button>
                                                            <div class="dropdown-menu" style="min-width:400px;">
                                                                <div class="card border-0 shadow">
                                                                    <div class="card-body">
                                                                        <h2 class="mb-4">Comment Reply</h2>
                                                                        <form action="{{ route('comment.reply') }}" method="POST">
                                                                            @csrf
                                                                            @if (!Auth::guard('admin')->check())
                                                                                <div class="row">
                                                                                    <div class="col-md-6 mb-3">
                                                                                        <label for="name" class="mb-2">Your Name*</label>
                                                                                        <input type="text" id="name" name="user_name" class="form-control" required />
                                                                                        @error('user_name')
                                                                                            <span class="text-danger">{{ $message }}</span>
                                                                                        @enderror
                                                                                    </div>
                                                                                    <div class="col-md-6 mb-3">
                                                                                        <label for="email" class="mb-2">Your Email*</label>
                                                                                        <input type="email" id="email" name="user_email" class="form-control" required />
                                                                                        @error('user_email')
                                                                                            <span class="text-danger">{{ $message }}</span>
                                                                                        @enderror
                                                                                    </div>
                                                                                </div>
                                                                            @else
                                                                                <input type="text" id="name" name="user_name" value="{{ Auth::guard('admin')->user()->name }}" class="form-control" hidden />
                                                                                <input type="email" id="email" name="user_email" value="{{ Auth::guard('admin')->user()->email }}" class="form-control" hidden />
                                                                            @endif
                                                                            <input type="text" name="parent_id" value="{{ $blogComment->id }}" required hidden />
                                                                            <input type="text" name="blog_id" value="{{ $blogSingle->id }}" required hidden />
                                                                            <div class="mb-4">
                                                                                <label for="comment" class="mb-2">Your Comment*</label>
                                                                                <textarea name="comment" id="comment" class="form-control" required></textarea>
                                                                                @error('comment')
                                                                                    <span class="text-danger">{{ $message }}</span>
                                                                                @enderror
                                                                            </div>
                                                                            <button class="btn btn-primary" type="submit">Submit Now</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <ol style="padding-left:80px;list-style: none;">
                                                @foreach ($blogComment->replies as $replies)
                                                    <li>
                                                        <div class="comment mb-4">
                                                            <div class="d-flex gap-3">
                                                                <figure>
                                                                    <img src="https://placehold.co/60x60?text={{ $replies->user_name }}" alt="">
                                                                </figure>
                                                                <div class="comment-text">
                                                                    <h5>{{ $replies->user_name }}</h5>
                                                                    <span class="mb-3 d-block"><strong>Date:</strong> {{ $replies->created_at->format('M j, Y') }}</span>
                                                                    <p>{{ $replies->comment }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ol>
                                        </li>
                                    @endforeach
                                @else
                                    <h5>There are have no any post!</h5>
                                @endif
                            </ul>
                        </div>
                    </div>

                    <div class="p-4">
                        <div class="card border-0 shadow">
                            <div class="card-body">
                                <h2 class="mb-4">Comment Form</h2>
                                <form action="{{ route('comment.store') }}" method="POST">
                                    @csrf
                                    @if (!Auth::guard('admin')->check())
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="name" class="mb-2">Your Name*</label>
                                                <input type="text" id="name" name="user_name" class="form-control" required />
                                                @error('user_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="email" class="mb-2">Your Email*</label>
                                                <input type="email" id="email" name="user_email" class="form-control" required />
                                                @error('user_email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    @else
                                        <input type="text" id="name" name="user_name" value="{{ Auth::guard('admin')->user()->name }}" class="form-control" required hidden />
                                        <input type="email" id="email" name="user_email" value="{{ Auth::guard('admin')->user()->email }}" class="form-control" required hidden />
                                    @endif
                                    <div class="mb-4">
                                        <label for="comment" class="mb-2">Your Comment*</label>
                                        <textarea name="comment" id="comment" class="form-control" required></textarea>
                                        @error('comment')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    {{-- Get Blog Id --}}
                                    <input type="text" name="blog_id" value="{{ $blogSingle->id }}" class="form-control" required hidden />

                                    <button class="btn btn-primary" type="submit">Submit Now</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
