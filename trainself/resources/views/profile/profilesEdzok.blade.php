@extends('layouts.main')

@section('content')
    <h1 class="display-1">
        {{ __('Edzők') }}
    </h1>
    <p class="mb-5">{{ __('Az oldalon elérhető összes edző megtekinthető')}}</p>

    <div class="row">
        <div class="col-md-8 col-lg-6 mx-auto">
            @forelse ($users as $user)
                @if(Auth::user() != $user)
                    @include('profile._item')  
                @endif  
                @empty
                    <div class="alert alert-warning">
                         {{__('Nincsen edző regisztrálva')}}
                    </div>
            @endforelse
        </div>
    </div>

@endsection