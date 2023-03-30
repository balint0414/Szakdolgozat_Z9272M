<div class="container">
    <header class="blog-header lh-1 py-3">
      <div class="row flex-nowrap justify-content-between align-items-center">
        <div class="col-4 pt-1">
        </div>
        <div class="col-4 text-center">
          <a class="blog-header-logo text-dark" href="{{route('home')}}">Trainself</a>
        </div>
        <div class="col-4 d-flex justify-content-end align-items-center">
          @auth
            <a class="btn btn-primary btn-sm" href="{{route('post.create')}}">{{__('Publikálási oldal')}}</a>
            <div class="nav-item dropdown ms-3">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" 
                aria-expanded="false" href="#">
                <img class="rounded-circle me-2" src="{{Auth::user()->avatar_image}}" alt="" width="25">
                {{Auth::user()->name}}
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li>
                    <a class="dropdown-item" href="{{route('profile.details', Auth::user())}}">{{__('Profil')}}</a>
                  </li>
                  @if(Auth::user()->role == "admin")
                    <li>
                      <a class="dropdown-item" href="{{ route('post.decide') }}">{{ __('Publikációs kérelmek') }}</a>
                    </li>
                  @endif
                  <li>
                    <a class="dropdown-item" href="{{ route('friend.show') }}">{{__('Barátnak jelölések')}}</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="{{ route('messages.index') }}">{{__('Üzenetek')}}</a>
                  </li>
                  @if(Auth::user()->role == "Edző")
                    <li>
                      <a class="dropdown-item" href="{{ route('booking.create') }}">{{ __('Időpont létrehozása') }}</a>
                    </li>
                  @endif
                  @if(Auth::user()->role == "Edző" || Auth::user()->role == "Tanítvány")
                    <li>
                      <a class="dropdown-item" href="{{ route('booking.booked_sessions') }}">{{ __('Lefoglalt időpontjaim') }}</a>
                    </li>
                  @endif
                  <li>
                    <form method="POST" action="{{route('logout')}}">
                      @csrf
                      <button class="dropdown-item" type="submit">
                          {{__('Kijelentkezés')}}
                      </button>
                    </form>
                  </li>
                </ul>
            </div>
          @else
            <a class="btn btn-sm btn-dark" href="{{route('register')}}">{{__('Regisztráció')}}</a>
            <a class="btn btn-sm ms-3 btn-dark" href="{{route('login')}}">{{__('Bejelentkezés')}}</a>
          @endauth
        </div>
      </div>
    </header>
  
    <div class="nav-scroller py-1 mb-2">
      <nav class="nav d-flex justify-content-between">
        <a class="p-2 link-secondary" href="{{route('topic.show',1)}}">{{__('Edzés cikkek')}}</a>
        <a class="p-2 link-secondary" href="{{route('topic.show',2)}}">{{__('Táplálkozás')}}</a>
        <a class="p-2 link-secondary" href="{{route('topic.show',3)}}">{{__('Edzőtermek')}}</a>
        <a class="p-2 link-secondary" href="{{route('edzok.show')}}">{{__('Edzők')}}</a>
        <a class="p-2 link-secondary" href="{{route('tanitvanyok.show')}}">{{__('Tanítványok')}}</a>
        @auth
        @if(Auth::user()->role != "admin")
          <a class="p-2 link-secondary" href="{{route('friends.list')}}">{{__('Barátaim')}}</a>
        @endif
        @endauth
      </nav>
    </div>
</div>