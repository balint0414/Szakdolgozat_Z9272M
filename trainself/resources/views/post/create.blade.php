@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-lg-6 col-md-10 mx-auto">
        <div class="card">
            <div class="card-body">
                <h3 class="display-3">{{__('Publikálás')}}</h3>
                <form action="{{route('post.create')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="title">{{__('Cím')}}</label>
                        <input class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}" type="text" name="title" 
                        value="{{ old('title') }}">
                        @if ($errors->has('title'))
                            <p class="invalid-feedback">Hibás cím</p>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="topic_id">{{__('Téma')}}</label>
                        <select class="form-control {{ $errors->has('topic_id') ? ' is-invalid' : '' }}" name="topic_id">
                            <option value="">{{__('Kérlek válassz')}}</option>
                            @foreach ($topics as $topic)
                                <option value="{{ $topic->id }}" {{ old('topic_id') == $topic->id ? 'selected' : '' }}>
                                    {{ $topic->title }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('topic_id'))
                            <p class="invalid-feedback">Nem választott témát</p>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="description">{{__('Leírás')}}</label>
                        <textarea class="form-control {{ $errors->has('description') ? ' is-invalid' : '' }}" name="description">{{ old('description') }}</textarea>
                        @if ($errors->has('description'))
                            <p class="invalid-feedback">Hibás leírás</p>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="content">{{__('Tartalom')}}</label>
                        <textarea class="form-control {{ $errors->has('content') ? ' is-invalid' : '' }}" name="content">{{ old('content') }}</textarea>
                        @if ($errors->has('content'))
                            <p class="invalid-feedback">Hibás tartalom</p>
                        @endif
                    </div>
                    <div class="d-grid">
                        <button class="btn btn-primary btn-lg">Publikálás</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection