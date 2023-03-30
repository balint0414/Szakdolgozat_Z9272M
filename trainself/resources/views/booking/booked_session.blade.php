@extends('layouts.main')

@section('content')

<h1 class="mb-5">{{__('Lefoglalt időpontjaim')}}</h1>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{__('Időpontok')}}</div>

                <div class="card-body">
                    @if ($booked_sessions->count() > 0)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">{{__('Kezdési idő')}}</th>
                                    <th scope="col">{{__('Befejezési idő')}}</th>
                                    <th scope="col">{{__('Helyszín')}}</th>
                                    @if ($user->role === 'Edző')
                                        <th scope="col">{{__('Tanítvány')}}</th>
                                    @else
                                        <th scope="col">{{__('Edző')}}</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($booked_sessions as $session)
                                    <tr>
                                        <td>{{ $session->start_time }}</td>
                                        <td>{{ $session->end_time }}</td>
                                        <td>{{ $session->location }}</td>
                                        @if ($user->role === 'Edző')
                                            <td>
                                                <img class="rounded-circle me-2" src="{{$session->student->avatar_image}}" alt="" width="25">
                                                <a href="{{route('profile.details', $session->student)}}">{{ $session->student->name }}</a>
                                            </td>
                                        @else
                                            <td>
                                                <img class="rounded-circle me-2" src="{{$session->trainer->avatar_image}}" alt="" width="25">
                                                <a href="{{route('profile.details', $session->trainer)}}">{{ $session->trainer->name }}</a>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-warning" role="alert">
                            {{__('Nincsenek lefoglalt időpontok.')}}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection