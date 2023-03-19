@extends('layouts.main')

@section('content')
<h1 class="display-1">
    {{ __('Barátaim') }}
</h1>
<p class="mb-5">{{ __('Ezen az oldalon jelenik meg az összes barátod!')}}</p>

<div class="row">
    <div class="col-md-8 col-lg-6 mx-auto">
        @forelse ($friends as $friend) 
        <div class="card mb-3">
            <div class="card-header">{{ __('Profil') }}</div>
            <div class="card-body">
                <div class="d-flex">
                    <div class="me-3">
                        <img width="150" height="150" src="{{ $friend->avatar_image }}" alt="{{ $friend->name }}" style="object-fit: cover">
                    </div>
                    <div class="ms-3">
                        <p><strong>{{ __('Név') }}:</strong> {{ $friend->name }}</p>
                        <p><strong>{{ __('Email') }}:</strong> {{ $friend->email }}</p>
                        <p><strong>{{ __('Kor') }}:</strong> {{ $friend->age}}</p>
                        <p><strong>{{ __('Ország') }}:</strong> {{ $friend->country }}</p>
                        <p><strong>{{ __('Város') }}:</strong> {{ $friend->city }}</p>
                        <p><strong>{{__('A leírás elolvasására a profilra kattintva van lehetőség.')}}</p>
                    </div>
                </div>
            </div>
            <p class="text-end">
                <a class="btn btn-sm btn-primary me-3" href="{{route('profile.details', $friend)}}">Tovább a profilra...</a>
            </p>
        </div>    
            @empty
                <div class="alert alert-warning">
                     {{__('Nincsenek még barátaid.')}}
                </div>
        @endforelse
    </div>
</div>
@endsection