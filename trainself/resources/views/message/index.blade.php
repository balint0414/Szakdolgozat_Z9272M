@extends('layouts.main')

@section('content')
    <h1 class="mb-5">{{__('Üzeneteim')}}</h1>

    <a href="{{ route('messages.create') }}" class="btn btn-primary mb-5">{{__('Új üzenet küldése')}}</a>
    <a href="{{ route('messages.sent') }}" class="btn btn-secondary mr-2 mb-5">{{__('Elküldött üzeneteim')}}</a>
    <a href="{{ route('messages.received') }}" class="mb-5 btn btn-secondary">{{__('Beérkezett üzeneteim')}}</a>

    @if ($messages->count())
        <table class="table">
            <thead>
                <tr>
                    <th>{{__('Tárgy')}}</th>
                    <th>{{__('Feladó')}}</th>
                    <th>{{__('Dátum')}}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($messages as $message)
                    <tr>
                        <td>{{ $message->subject }}</td>
                        <td>{{ $message->sender->name }}</td>
                        <td>{{ $message->created_at->format('M j, Y g:i A') }}</td>
                        <td><a href="{{ route('messages.show', $message) }}">{{__('Üzenet olvasása')}}</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>{{__('Nincsenek még üzeneteid.')}}</p>
    @endif

@endsection