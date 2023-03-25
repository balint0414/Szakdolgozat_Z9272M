@extends('layouts.main')

@section('content')
    <h1>{{ $message->subject }}</h1>

    <p><strong>{{__('Feladó:')}}</strong> {{ $message->sender->name }}</p>
    <p><strong>{{__('Dátum:')}}</strong> {{ $message->created_at->format('M j, Y g:i A') }}</p>

    <p class="mb-5">{{ $message->body }}</p>

    <form method="POST" action="{{ route('messages.delete', $message) }}">
        @csrf
        <button type="submit" class="btn btn-danger">{{__('Üzenet törlése')}}</button>
    </form>
@endsection