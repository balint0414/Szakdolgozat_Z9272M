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
        <a class="btn btn-sm btn-primary me-3" href="{{route('profile.details', $user)}}">Tovább a profilra...</a>
    </p>
</div>