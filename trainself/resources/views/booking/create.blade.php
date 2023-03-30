@extends('layouts.main')

@section('content')

<h1 class="mb-5">{{__('Új edzési időpont létrehozása')}}</h1>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <form action="{{ route('booking.store') }}" method="POST">
                @csrf
                <input type="hidden" name="trainer_id" value="{{ Auth::id() }}">

                <div class="form-group">
                    <label for="location">{{__('Helyszín:')}}</label>
                    <input class="form-control mb-3" type="text" id="location" name="location" value="{{ old('location') }}" required>
                </div>

                <div class="form-group">
                    <label for="start_time">{{__('Kezdési idő:')}}</label>
                    <input class="form-control mb-3" type="datetime-local" id="start_time" name="start_time" value="{{ old('start_time') }}" required>
                </div>

                <div class="form-group">
                    <label for="end_time">{{__('Befejezési idő:')}}</label>
                    <input class="form-control mb-3" type="datetime-local" id="end_time" name="end_time" value="{{ old('end_time') }}" required>
                </div>

                <button class="btn btn-primary" type="submit">{{__('Időpont létrehozása')}}</button>
            </form>

            @if ($errors->any())
                <div class="alert alert-danger mt-3">
                    <strong>{{__('Hiba!')}}</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success mt-3">
                    <strong>{{__('Siker!')}}</strong> {{ session('success') }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection