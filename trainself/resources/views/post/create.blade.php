@extends('layouts.main')

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
@endpush

@section('content')
<form action="{{route('post.create')}}" method="POST" enctype="multipart/form-data">
@csrf
<div class="d-flex align-items-center mb-3">
    <h3 class="display-3">{{__('Publikálás')}}</h3>
    <button class="ms-auto btn btn-primary">Publikálás</button>
</div>
<div class="row">
    <div class="col-lg-8 col-md-6">
        <div class="card">
            <div class="card-body">
                    <div class="mb-3">
                        <label for="title">{{__('Cím')}}</label>
                        <input class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}" type="text" name="title" 
                        value="{{ old('title') }}">
                        @if ($errors->has('title'))
                            <p class="invalid-feedback">Hibás cím</p>
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
                        <textarea id="editor" class="form-control {{ $errors->has('content') ? ' is-invalid' : '' }}" name="content">{{ old('content') }}</textarea>
                        @if ($errors->has('content'))
                            <p class="invalid-feedback">Hibás tartalom</p>
                        @endif
                    </div>
                </div>
            </div>
    </div>
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body">
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
                        <label for="cover">{{__('Borítókép')}}</label>
                        <input class="form-control {{ $errors->has('cover') ? ' is-invalid' : '' }}" type="file" name="cover" 
                        value="{{ old('cover') }}">
                        @if ($errors->has('cover'))
                            <p class="invalid-feedback">Hibás borítókép</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
</div>
</form>
@endsection