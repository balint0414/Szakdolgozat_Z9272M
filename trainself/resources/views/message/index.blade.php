@extends('layouts.main')

@section('content')

<h1 class="mb-5">{{__('Üzeneteim')}}</h1>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="d-flex justify-content-between mb-5">
                <a href="{{ route('messages.create') }}" class="btn btn-primary">{{__('Új üzenet küldése')}}</a>
                <div>
                    <a href="{{ route('messages.sent') }}" class="btn btn-secondary mr-2">{{__('Elküldött üzeneteim')}}</a>
                    <a href="{{ route('messages.received') }}" class="btn btn-secondary">{{__('Beérkezett üzeneteim')}}</a>
                </div>
            </div>

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
                                <td><a href="{{ route('messages.show', $message) }}" class="btn btn-secondary btn-sm">{{__('Üzenet olvasása')}}</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>{{__('Nincsenek még üzeneteid.')}}</p>
            @endif
        </div>
    </div>
</div>

@endsection