<div class="card mb-3">
    <div class="card-header">{{ __('Profil') }}</div>
    <div class="card-body">
        <div class="d-flex">
            <div class="me-3">
                <img width="150" height="150" src="{{ $request->sender->avatar_image }}" alt="{{ $request->sender->name }}" style="object-fit: cover">
            </div>
            <div class="ms-3">
                <p><strong>{{ __('Név') }}:</strong> {{ $request->sender->name }}</p>
                <p><strong>{{ __('Email') }}:</strong> {{ $request->sender->email }}</p>
                <p><strong>{{ __('Kor') }}:</strong> {{ $request->sender->age}}</p>
                <p><strong>{{ __('Ország') }}:</strong> {{ $request->sender->country }}</p>
                <p><strong>{{ __('Város') }}:</strong> {{ $request->sender->city }}</p>
                <p><strong>{{__('A leírás elolvasására a profilra kattintva van lehetőség.')}}</p>
            </div>
        </div>
    </div>
    <p class="text-end">
        @if(auth()->id() !== $request->sender->id)
            <form action="{{ route('friend.accept') }}" method="POST">
                @csrf
                <input type="hidden" name="sender_id" value="{{ $request->sender->id }}">
                <button class="btn btn-primary mb-3" type="submit">{{__('Elfogadom')}}</button>
            </form>
        @endif
        <a class="btn btn-sm btn-primary me-3" href="{{route('profile.details', $request->sender)}}">Tovább a profilra...</a>
    </p>
</div>