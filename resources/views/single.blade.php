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
                        <div class="d-flex gap-3 flex-wrap mb-2">
                            <p><strong>Author:</strong> {{ $blogSingle->author->name }}</p>
                            <p><strong>Category:</strong> <button class="btn btn-sm btn-light">{{ $blogSingle->category->name }}</button></p>
                            <p><strong>Created At:</strong> {{ $blogSingle->created_at->format('M j, Y') }}</p>
                            @php
                                $commentCount = $blogSingle->comments->count();
                                $getCount = $commentCount > 9 ? $commentCount : '0' . $commentCount;
                            @endphp
                            <p><strong>Comments:</strong> {{ $getCount }}</p>
                        </div>
                        {{-- Reaction --}}
                        <div class="reaction d-flex align-items-center gap-2">
                            <div class="d-flex align-items-center gap-3">
                                <form action="#">
                                    <button type="submit" class="btn btn-sm btn-light py-2 px-3 d-flex align-items-center gap-1">
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="30" height="30" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                                <g>
                                                    <path fill="#2196f3" fill-rule="evenodd" d="M256 512c140.997 0 256-115.003 256-256S396.997 0 256 0 0 115.003 0 256s115.003 256 256 256z" clip-rule="evenodd" opacity="1" data-original="#2196f3" class=""></path>
                                                    <path fill="#ffffff"
                                                        d="M126.318 206.456h56.704v163.048c-1.604 7.982-8.984 13.959-17.324 13.959h-39.38c-9.549 0-17.318-7.775-17.318-17.324V223.774c0-9.548 7.769-17.318 17.318-17.318zm269.641 18.977c-8.856-11.353-24.777-18.976-39.617-18.976h-83.529a4.248 4.248 0 0 1-3.383-1.683 4.245 4.245 0 0 1-.711-3.718l10.557-37.862c10.162-36.434-3.25-46.603-34.089-59.723-2.885-1.227-5.692-1.245-8.589-.061-2.897 1.178-4.884 3.153-6.087 6.044l-38.985 93.594v164.045l39.283 16.37h104.03c30.767 0 42.284-32.674 45.807-46.718l21.509-85.649c2.782-11.085-1.834-20.075-6.196-25.663z"
                                                        opacity="1" data-original="#ffffff" class=""></path>
                                                </g>
                                            </svg>
                                        </span>
                                        Like
                                    </button>
                                </form>
                            </div>
                            <div class="d-flex align-items-center gap-3">
                                <form action="#">
                                    <button type="submit" class="btn btn-sm btn-light py-2 px-3 d-flex align-items-center gap-1">
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="30" height="30" x="0" y="0" viewBox="0 0 152 152" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                                <g>
                                                    <g data-name="Layer 2">
                                                        <g data-name="06.Dislike">
                                                            <circle cx="76" cy="76" r="76" fill="#eb2540" opacity="1" data-original="#eb2540" class=""></circle>
                                                            <path fill="#ffffff"
                                                                d="M95.43 41.26a4.88 4.88 0 0 1 4.87-4.84h13.34a4.87 4.87 0 0 1 4.86 4.84v38.05a4.88 4.88 0 0 1-4.86 4.85H100.3a4.88 4.88 0 0 1-4.87-4.85zM38.64 71.07a6.63 6.63 0 0 1 2.66-11.63 6.62 6.62 0 0 1 2.64-11.63A6.64 6.64 0 0 1 48.07 36l37.62.42a4.86 4.86 0 0 1 4.84 4.84v38.05c0 6-19.19 17.08-20.22 23-.64 3.82.21 13.64-2.43 13.64-4.48 0-10.23-1.72-10.23-11.67 0-8.78 5.75-20.17 5.75-20.17H40.13a6.63 6.63 0 0 1-1.49-13.09z"
                                                                opacity="1" data-original="#ffffff"></path>
                                                        </g>
                                                    </g>
                                                </g>
                                            </svg>
                                        </span>
                                        DisLike
                                    </button>
                                </form>
                            </div>

                            <div class="reaction-count ms-4 mb-2 d-flex align-items-center gap-2">
                                <span class="text-muted">Like(02)</span>
                                <span class="text-muted">Dislike(05)</span>
                            </div>
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
                                        @if ($blogComment->status == 'approve')
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
                                                    @if ($blogComment->replies->count() > 0)
                                                        @foreach ($blogComment->replies as $replies)
                                                            @if ($replies->status == 'approve')
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
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </ol>
                                            </li>
                                        @endif
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


@push('scripts')
    <script>
        $(document).ready(function() {

        });
    </script>
@endpush
