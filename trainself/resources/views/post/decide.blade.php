@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-md-8 col-lg-6 mx-auto">
        @forelse ($posts as $post)
            @include('post._item')
            @empty
                    <div class="alert alert-warning">
                         {{__('Még senki nem küldött publikációs kérelmet!')}}
                    </div>
        @endforelse
    </div>
</div>
{{ $posts->links() }}
@endsection