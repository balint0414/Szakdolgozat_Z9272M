@extends('layouts.main');

@section('content')
    <h1 class="display-3">{{ $post->title }}</h1>
    <p>{{ $post->author->name }} | {{ $post->topic->title }} | {{ $post->created_at->diffForHumans()}}</p>
    <p class="fw-bold">{{ $post->description }}</p>
    <div>
        {{ $post->content }}
    </div>
@endsection