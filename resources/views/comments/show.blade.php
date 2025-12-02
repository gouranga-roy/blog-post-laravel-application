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
                        <h3>{{ $comments->title }}</h3>
                    </div>
                    <div class="card-body">
                        <h4 class="mb-4">All Comments</h4>
                        <div class="comment-items">
                            <ul style="margin:0;padding:0;list-style:none;">
                                @if ($comments->comments->count() > 0)
                                    @foreach ($comments->comments as $comment)
                                        <li>
                                            <div class="comment mb-4">
                                                <div class="d-flex gap-3">
                                                    <figure>
                                                        <img src="https://placehold.co/60x60?text={{ $comment->user_name }}" alt="">
                                                    </figure>
                                                    <div class="comment-text">
                                                        <h4>{{ $comment->user_name }}</h4>
                                                        <span class="mb-3 d-block"><strong>Date:</strong> {{ $comment->created_at->diffForHumans() }}</span>
                                                        <p>{{ $comment->id }}--{{ $comment->comment }}</p>
                                                        <form action="{{ route('comment.status', $comment->id) }}" method="POST">
                                                            @csrf
                                                            <input type="text" name="comment_id" value="{{ $comment->id }}" class="form-control" required hidden />
                                                            @if ($comment->status == 'unapprove')
                                                                <button type="submit" class="btn btn-danger">Approve</button>
                                                            @else
                                                                <button type="submit" class="btn btn-primary">Unapprove</button>
                                                            @endif
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <ol style="padding-left:80px;list-style: none;">
                                                @foreach ($comment->replies as $replie)
                                                    <li>
                                                        <div class="comment mb-4">
                                                            <div class="d-flex gap-3">
                                                                <figure>
                                                                    <img src="https://placehold.co/60x60?text={{ $replie->user_name }}" alt="">
                                                                </figure>
                                                                <div class="comment-text">
                                                                    <h4>{{ $replie->user_name }}</h4>
                                                                    <span class="mb-3 d-block"><strong>Date:</strong> {{ $replie->created_at->diffForHumans() }}</span>
                                                                    <p>{{ $replie->comment }}</p>
                                                                    @if ($comment->status == 'approve')
                                                                        <form action="{{ route('comment.status', $replie->id) }}" method="POST">
                                                                            @csrf
                                                                            <input type="text" name="comment_id" value="{{ $replie->id }}" class="form-control" required hidden />

                                                                            @if ($replie->status == 'unapprove')
                                                                                <button type="submit" class="btn btn-danger">Approve</button>
                                                                            @else
                                                                                <button type="submit" class="btn btn-primary">Unapprove</button>
                                                                            @endif
                                                                        </form>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ol>
                                        </li>
                                    @endforeach
                                @else
                                    <h6 class="text-info">No Comments yeat!</h6>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
