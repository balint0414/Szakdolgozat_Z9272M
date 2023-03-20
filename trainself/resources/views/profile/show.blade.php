@extends('layouts.main');

@section('content')
<div class="container">
    <div class="d-flex align-items-center mb-3">
        <h1 class="display-3 mb-5">{{ $user->name }} profilja</h1>
        @if(Auth::user() == $user)
        <a class="ms-auto btn btn-primary" href="{{route('profile.edit', $user)}}">Szerkesztés</a>
        @endif
    </div>

    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card mb-3">
                <div class="card-header">{{ __('Profil') }}</div>
                <div class="card-body">
                    <div class="d-flex">
                        <div class="me-3">
                            <img width="150" height="150" src="{{ $user->avatar_image }}" alt="{{ $user->name }}" style="object-fit: cover">
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
</div>
@endsection