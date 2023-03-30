@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-md-8 col-lg-6 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h3 class="display-3">{{ __('Bejelentkezés') }}</h3>
                    <form action="{{route('login')}}" method="POST">
                        @csrf
                        <x-forms.input name="email" type="email" label="{{ __('Email cím')}}"/>
                        <x-forms.input name="password" type="password" label="{{ __('Jelszó')}}"/>

                        <div class="d-grid">
                            <button class="btn btn-primary btn-lg" type="submit">
                                {{ __('Bejelentkezés')}}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection