@extends('layouts.main')

@section('content')

<h1 class="mb-3">{{__('Új üzenet küldése')}}</h1>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <form method="POST" action="{{ route('messages.store') }}">
                @csrf

                @if ($recipientId)
                    <input type="hidden" name="recipient_id" value="{{ $recipientId }}">
                @else
                    <div class="form-group">
                        <label class="mb-2" for="recipient_id">{{__('Címzett:')}}</label>
                        <select name="recipient_id" id="recipient_id" class="form-control mb-3">
                            @foreach ($friends as $friendId => $friendName)
                                @if($friendName != Auth::user()->name)
                                    <option value="{{ $friendId }}">{{ $friendName }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('recipient_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                @endif

                <div class="form-group">
                    <label class="mb-2" for="subject">{{__('Tárgy:')}}</label>
                    <input id="subject" type="text" name="subject" class="mb-3 form-control @error('subject') is-invalid @enderror" value="{{ old('subject') }}">
                    @error('subject')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="mb-2" for="body">{{__('Üzenet:')}}</label>
                    <textarea id="body" name="body" class="mb-3 form-control @error('body') is-invalid @enderror">{{ old('body') }}</textarea>
                    @error('body')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">{{_('Üzenet elküldése')}}</button>
            </form>
        </div>
    </div>
</div>
@endsection