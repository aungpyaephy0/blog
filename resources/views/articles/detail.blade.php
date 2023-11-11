@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card mb-2">
            <div class="card-body">
                <h5 class="card-title">{{ $article->title }}</h5>
                <div class="card-subtitle mb-2 text-muted small">
                    {{ $article->created_at->diffForHumans() }}
                    Category: <b>{{ $article->category->name }}</b>
                </div>
                <p class="card-text">{{ $article->body }}</p>
                <a class="btn btn-outline-danger" href="{{ url("/articles/delete/$article->id") }}">
                    Delete
                </a>
            </div>
        </div>
        <ul class="list-group">
            <li class="list-group-item active" style="background-color: #3b6099; border-color:#3b6099">
                <b>Comments ({{ count($article->comments) }})</b>
            </li>
            @foreach ($article->comments as $comment)
                <li class="list-group-item">
                    <b class="text-info">{{ $comment->user->name }} </b>
                    <br>
                    {{ $comment->content }}

                </li>
            @endforeach
        </ul>

        <form action="{{ url('/comments/add') }}" method="POST">
            @csrf
            <input type="hidden" name="article_id" value="{{ $article->id }}">
            <textarea name="content" class="form-control mb-3 mt-4" placeholder="New Comment"></textarea>
            <input type="submit" value="Add Comment" class="btn btn-info">
        </form>
    </div>
@endsection
