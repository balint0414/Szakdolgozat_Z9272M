@extends('layouts.main')

@section('content')

<div class="container">
        <h1 class="display-3 mb-5">{{ $user->name }} profiljának szerkesztése</h1>
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">{{ __('Profil szerkesztése') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('profile.update', $user) }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Név') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="mb-3 form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $user->name) }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email cím') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="mb-3 form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="country" class="col-md-4 col-form-label text-md-right">{{ __('Ország') }}</label>

                            <div class="col-md-6">
                                <input id="country" type="text" class="mb-3 form-control @error('country') is-invalid @enderror" name="country" value="{{ old('country', $user->country) }}" autocomplete="country">

                                @error('country')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('Város') }}</label>

                            <div class="col-md-6">
                                <input id="city" type="text" class="mb-3 form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city', $user->city) }}" autocomplete="city">

                                @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="age" class="col-md-4 col-form-label text-md-right">{{ __('Kor') }}</label>

                            <div class="col-md-6">
                                <input id="age" type="number"
                                class="mb-3 form-control @error('age') is-invalid @enderror" name="age" value="{{ old('age', $user->age) }}" autocomplete="age">

                                @error('age')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Leírás') }}</label>

                            <div class="col-md-6">
                                <textarea id="description" class="mb-3 form-control @error('description') is-invalid @enderror" name="description" autocomplete="description">{{ old('description', $user->description) }}</textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="avatar" class="col-md-4 col-form-label text-md-right">{{ __('Profilkép') }}</label>

                            <div class="col-md-6">
                                <input id="avatar" type="file" class="form-control-file @error('avatar') is-invalid @enderror" name="avatar" value="{{ old('avatar', $user->avatar) }}" accept="image/*">

                                @error('avatar')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                @if ($user->avatar)
                                    <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="mt-2 img-thumbnail w-50">
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Profil frissítése') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection