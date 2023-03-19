@extends('layouts.main')

@section('content')
<h1 class="display-1">
    {{ __('Barátnak jelölések') }}
</h1>
<p class="mb-5">{{ __('Ezen az oldalon jelenik meg az összes bartának jelölésed!')}}</p>

<div class="row">
    <div class="col-md-8 col-lg-6 mx-auto">
        @forelse ($friendRequests as $request)
            @if($request->is_accepted == false) 
                @include('friend._item')
            @endif    
            @empty
                <div class="alert alert-warning">
                     {{__('Nincsen barátnak jelölésed')}}
                </div>
        @endforelse
    </div>
</div>
@endsection