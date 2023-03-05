@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-md-8 col-lg-6 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h3 class="display-3">{{ __('Regisztráció') }}</h3>
                    <form action="{{route('register')}}" method="POST">
                        @csrf
                        <x-forms.input name="name" label="{{ __('Teljes név')}}"/>
                        <x-forms.input name="email" type="email" label="{{ __('Email cím')}}"/>
                        <x-forms.input name="password" type="password" label="{{ __('Jelszó')}}"/>
                        <x-forms.input name="password_confirmation" type="password" label="{{ __('Jelszó megerősítése')}}"/>
                        <div class="d-grid">
                            <button class="btn btn-primary btn-lg" type="submit">
                                {{ __('Regisztráció')}}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection