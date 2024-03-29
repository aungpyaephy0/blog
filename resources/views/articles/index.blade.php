@extends('layouts.app')
@section('content')
<div class="container">

    {{ $articles->links() }}
    @if(session('info'))
        <div class="alert alert-info">
            {{session('info')}}
        </div>
    @endif
    @foreach ($articles as $article)
    <div class="card mb-2">
                <div class="card-body">
                    <h5 class="card-title">Title: {{ $article->title }}</h5>
                    <div class="card-subtitle mb-2 text-muted small">
                        <b style="color:rgb(26, 102, 119)">
                            User: {{$article->user->name}},
                            Category: {{$article->category->name}},
                        </b>
                        {{ $article->created_at->diffForHumans() }}
                    </div>

                    <p class="card-text">{{ $article->body }}</p>
                    <a class="card-link" href="{{ url("/articles/detail/$article->id") }}">
                        View Detail &raquo;
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
