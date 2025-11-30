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
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Reply
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <div class="card border-0 shadow">
                                                            <div class="card-body">
                                                                <h2 class="mb-4">Comment Reply</h2>
                                                                <form action="#" method="POST">
                                                                    @if (!Auth::guard('admin')->check())
                                                                        <div class="row">
                                                                            <div class="col-md-6 mb-3">
                                                                                <label for="name" class="mb-2">Your Name*</label>
                                                                                <input type="text" id="name" name="name" class="form-control" />
                                                                            </div>
                                                                            <div class="col-md-6 mb-3">
                                                                                <label for="email" class="mb-2">Your Email*</label>
                                                                                <input type="email" id="email" name="email" class="form-control" />
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                    <div class="mb-4">
                                                                        <label for="comment" class="mb-2">Your Comment*</label>
                                                                        <textarea name="comment" id="comment" class="form-control"></textarea>
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
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Reply
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <div class="card border-0 shadow">
                                                            <div class="card-body">
                                                                <h2 class="mb-4">Comment Reply</h2>
                                                                <form action="#" method="POST">
                                                                    @if (!Auth::guard('admin')->check())
                                                                        <div class="row">
                                                                            <div class="col-md-6 mb-3">
                                                                                <label for="name" class="mb-2">Your Name*</label>
                                                                                <input type="text" id="name" name="name" class="form-control" />
                                                                            </div>
                                                                            <div class="col-md-6 mb-3">
                                                                                <label for="email" class="mb-2">Your Email*</label>
                                                                                <input type="email" id="email" name="email" class="form-control" />
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                    <div class="mb-4">
                                                                        <label for="comment" class="mb-2">Your Comment*</label>
                                                                        <textarea name="comment" id="comment" class="form-control"></textarea>
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
                                </li>
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
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Reply
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <div class="card border-0 shadow">
                                                            <div class="card-body">
                                                                <h2 class="mb-4">Comment Reply</h2>
                                                                <form action="#" method="POST">
                                                                    @if (!Auth::guard('admin')->check())
                                                                        <div class="row">
                                                                            <div class="col-md-6 mb-3">
                                                                                <label for="name" class="mb-2">Your Name*</label>
                                                                                <input type="text" id="name" name="name" class="form-control" />
                                                                            </div>
                                                                            <div class="col-md-6 mb-3">
                                                                                <label for="email" class="mb-2">Your Email*</label>
                                                                                <input type="email" id="email" name="email" class="form-control" />
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                    <div class="mb-4">
                                                                        <label for="comment" class="mb-2">Your Comment*</label>
                                                                        <textarea name="comment" id="comment" class="form-control"></textarea>
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
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="p-4">
                        <div class="card border-0 shadow">
                            <div class="card-body">
                                <h2 class="mb-4">Comment Form</h2>
                                <form action="#" method="POST">
                                    @if (!Auth::guard('admin')->check())
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="name" class="mb-2">Your Name*</label>
                                                <input type="text" id="name" name="name" class="form-control" />
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="email" class="mb-2">Your Email*</label>
                                                <input type="email" id="email" name="email" class="form-control" />
                                            </div>
                                        </div>
                                    @endif
                                    <div class="mb-4">
                                        <label for="comment" class="mb-2">Your Comment*</label>
                                        <textarea name="comment" id="comment" class="form-control"></textarea>
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
@endsection
