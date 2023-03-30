@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>{{ $message->subject }}</h1>

                <div class="card mb-5">
                    <div class="card-body">
                        <p><strong>{{__('Feladó:')}}</strong> {{ $message->sender->name }}</p>
                        <p><strong>{{__('Dátum:')}}</strong> {{ $message->created_at->format('M j, Y g:i A') }}</p>

                        <p>{{ $message->body }}</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('messages.delete', $message) }}">
                    @csrf
                    <button type="submit" class="btn btn-danger">{{__('Üzenet törlése')}}</button>
                </form>
            </div>
        </div>
    </div>
@endsection