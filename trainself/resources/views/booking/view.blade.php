@extends('layouts.main')

@section('content')

<h1 class="mb-5">{{ $trainer->name }} edzéseinek időpontjai</h1>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @if ($sessions->count() > 0)
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>{{__('Kezdési idő')}}</th>
                        <th>{{__('Befejezési idő')}}</th>
                        <th>{{__('Helyszín')}}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sessions as $session)
                        <tr>
                            <td>{{ $session->start_time }}</td>
                            <td>{{ $session->end_time }}</td>
                            <td>{{ $session->location }}</td>
                            <td>
                                @if(Auth::user()->role == 'Tanítvány')
                                <form action="{{ route('booking.book', $session->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="student_id" value="{{ Auth::id() }}">
                                    <button class="btn btn-primary btn-sm" type="submit">{{__('Foglalás')}}</button>
                                </form>
                                @endif
                                @if(Auth::user()->id == $session->trainer_id || Auth::user()->role == 'admin')
                                <form action="{{ route('booking.destroy', $session->id) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-danger" type="submit">{{__('Törlés')}}</button>
                                </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @else
                <div class="alert alert-warning">
                    {{__('Nincsen lefoglalható időpont!')}}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection