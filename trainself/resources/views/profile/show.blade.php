@extends('layouts.main');

@section('content')
<div class="container">
    <div class="d-flex align-items-center mb-3">
        <h1 class="display-3 mb-5">{{ $user->name }} profilja</h1>
        @if(Auth::user() != $user)
        <a href="{{ route('messages.create', ['recipient_id' => $user->id]) }}" class="ms-auto btn btn-primary">{{__('Üzenet küldés')}}</a>
        @endif
        @if(Auth::user() == $user)
        <a class="ms-auto btn btn-primary" href="{{route('profile.edit', $user)}}">Szerkesztés</a>
        @endif
    </div>

    <div class="row mb-5">
        <div class="col-md-8 offset-md-2">
            <div class="card mb-3">
                <div class="card-header">{{ __('Profil') }}</div>
                <div class="card-body">
                    <div class="d-flex">
                        <div class="me-3">
                            <img class="mb-5" width="150" height="150" src="{{ $user->avatar_image }}" alt="{{ $user->name }}" style="object-fit: cover">
                            @if(auth()->check() && auth()->id() !== $user->id)
                                @php
                                    $isFriend = Auth::user()->sentFriends->contains($user->id) || Auth::user()->receivedFriends->contains($user->id);
                                    $requestSent = Auth::user()->sentFriendRequests->contains('receiver_id', $user->id);
                                @endphp
                                @if(!$isFriend && !$requestSent)
                                    <form action="{{ route('friend.request') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="receiver_id" value="{{ $user->id }}">
                                        <button class="btn btn-primary mb-3" type="submit">{{__('Barátnak jelölöm')}}</button>
                                    </form>
                                @endif
                            @endif
                        </div>
                        <div class="ms-3">
                            <p><strong>{{ __('Név') }}:</strong> {{ $user->name }}</p>
                            <p><strong>{{ __('Email') }}:</strong> {{ $user->email }}</p>
                            <p><strong>{{ __('Kor') }}:</strong> {{ $user->age}}</p>
                            <p><strong>{{ __('Ország') }}:</strong> {{ $user->country }}</p>
                            <p><strong>{{ __('Város') }}:</strong> {{ $user->city }}</p>
                            <p><strong>{{ __('Leírás') }}:</strong> {{ $user->description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($user->role === 'Edző')
        <h1 class="mb-3">{{__('Időpont foglalás:')}}</h1>
        <a href="{{ route('booking.index', ['trainer_id' => $user->id]) }}" class="btn btn-primary mb-5">{{__('Az edző időpontjai')}}</a>
    @endif

    @if(Auth::user() == $user)
        <h1 class="mb-5">{{__('Publikációim:')}}</h1>
    @else
        <h1 class="mb-5">{{__('Publikációi:')}}</h1>
    @endif

    <div class="row">
        <div class="col-md-8 col-lg-6 mx-auto">
            @forelse ($posts as $post) 
                @include('post._item')    
                @empty
                    <div class="alert alert-warning">
                         {{__('Nincsen még poszt feltöltve!')}}
                    </div>
            @endforelse
        </div>
    </div>

</div>
@endsection