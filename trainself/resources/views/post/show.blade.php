@extends('layouts.main');

@section('content')
    <h1 class="display-3">{{ $post->title }}</h1>
    <p>{{ $post->author->name }} | {{ $post->topic->title }} | {{ $post->created_at->diffForHumans()}}</p>
    <p class="fw-bold">{{ $post->description }}</p>
    @auth
    @if(Auth::user()->role == "admin" && $post->published == false)
        <form method="POST" action="{{ route('post.accept', $post->id) }}">
            @csrf
            <button class="btn btn-primary mt-3 mb-3" type="submit">Engedélyezem a posztot</button>
        </form>
    @endif
    @endauth
    <div>
        {!! $post->content !!}
    </div>

    <!-- Hozzászólási rész  -->
    <div class="row mt-5">
        <div class="col-md-8 col-lg-6 mx-auto">
            <h5 class="display-5">
                {{__('Hozzászólás')}}
            </h5>
            @auth
            <form action="{{route('post.comment', $post)}}" method="POST">
                @csrf
                <div class="mb-3">
                    <textarea class="form-control" name="comment"></textarea>
                </div>
                <div class="d-grid">
                    <button class="btn btn-primary">{{__('Kommentelés')}}</button>
                </div>
            @else
                <div class="d-grid mb-3">
                    <a class="btn btn-primary" href="{{route('login')}}">
                        {{__('Kommenteléshez lépjen be!')}}
                    </a>
                </div>
            @endif
                
            </form>

            <div class="mt-5">
                @foreach ($post->comments as $comment)
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="mb-3 d-flex">
                            <div class="d-flex">
                                {{$comment->user->name}} {{__('hozzászólása: ')}}
                            </div>
                            <span class="ms-3">
                                ({{$comment->created_at->diffForHumans()}})
                            </span>
                        </div>
                        <div style="white-space: pre-line;">
                            {{$comment->message}}
                        </div>   
                    </div>
                </div>
                @endforeach
            </div>   
        </div>
    </div>
@endsection