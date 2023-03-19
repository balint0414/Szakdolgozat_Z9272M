<div class="card mb-3">
    <div class="card-header">{{ __('Profil') }}</div>
    <div class="card-body">
        <div class="d-flex">
            <div class="me-3">
                <img width="150" height="150" src="{{ $user->avatar_image }}" alt="{{ $user->name }}" style="object-fit: cover">
            </div>
            <div class="ms-3">
                <p><strong>{{ __('Név') }}:</strong> {{ $user->name }}</p>
                <p><strong>{{ __('Email') }}:</strong> {{ $user->email }}</p>
                <p><strong>{{ __('Kor') }}:</strong> {{ $user->age}}</p>
                <p><strong>{{ __('Ország') }}:</strong> {{ $user->country }}</p>
                <p><strong>{{ __('Város') }}:</strong> {{ $user->city }}</p>
                <p><strong>{{__('A leírás elolvasására a profilra kattintva van lehetőség.')}}</p>
            </div>
        </div>
    </div>
    <p class="text-end">
        @if(auth()->id() !== $user->id)
            @php
                $isFriend = auth()->user()->sentFriends->contains($user->id) || auth()->user()->receivedFriends->contains($user->id);
            @endphp
            @if(!$isFriend)
                <form action="{{ route('friend.request') }}" method="POST">
                    @csrf
                    <input type="hidden" name="receiver_id" value="{{ $user->id }}">
                    <button class="btn btn-primary mb-3" type="submit">{{__('Barátnak jelölöm')}}</button>
                </form>
            @endif
        @endif
        <a class="btn btn-sm btn-primary me-3" href="{{route('profile.details', $user)}}">Tovább a profilra...</a>
    </p>
</div>