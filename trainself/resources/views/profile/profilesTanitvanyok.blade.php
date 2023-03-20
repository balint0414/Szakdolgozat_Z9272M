@extends('layouts.main')

@section('content')
    <h1 class="display-1">
        {{ __('Tanítványok') }}
    </h1>
    <p class="mb-5">{{ __('Az oldalon elérhető összes tanítvány megtekinthető')}}</p>

    <form action="{{ route('tanitvany.search.results') }}" method="POST">
        @csrf
        <div class="input-group mb-5">
            <label class="input-group-text" for="inputGroupSelect01">{{__('Szűrő')}}</label>
            <select class="form-select" name="search_type" id="search_type">
                <option value="name">{{__('Név')}}</option>
                <option value="city">{{__('Város')}}</option>
            </select>
            <input type="text" class="form-control" aria-label="search" id="query" name="query">
            <button class="btn btn-outline-secondary" type="submit">{{__('Keresés')}}</button>
          </div>
        </form>

    <div class="row">
        <div class="col-md-8 col-lg-6 mx-auto">
            @forelse ($users as $user)
                @if(Auth::user() != $user)
                    @include('profile._item')
                @endif    
                @empty
                    <div class="alert alert-warning">
                         {{__('Nincsen tanítvány regisztrálva')}}
                    </div>
            @endforelse
        </div>
    </div>

@endsection