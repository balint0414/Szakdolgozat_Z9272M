<div class="container">
    <header class="blog-header lh-1 py-3">
      <div class="row flex-nowrap justify-content-between align-items-center">
        <div class="col-4 pt-1">
        </div>
        <div class="col-4 text-center">
          <a class="blog-header-logo text-dark" href="{{route('home')}}">Trainself</a>
        </div>
        <div class="col-4 d-flex justify-content-end align-items-center">
          <a class="link-secondary" href="#" aria-label="Search">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="mx-3" role="img" viewBox="0 0 24 24"><title>Search</title><circle cx="10.5" cy="10.5" r="7.5"/><path d="M21 21l-5.2-5.2"/></svg>
          </a>
          @auth
            <a class="btn btn-primary btn-sm" href="{{route('post.create')}}">{{__('Publikálási oldal')}}</a>
            <div class="nav-item dropdown ms-3">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" 
                aria-expanded="false" href="#">{{Auth::user()->name}}</a>
                <ul class="dropdown-menu" aria-labbeled-by="navbarDropdown">
                  <li>
                    <a class="dropdown-item" href="#">{{__('Profil')}}</a>
                  </li>
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
            <a class="btn btn-sm btn-outline-secondary ms-3" href="{{route('login')}}">{{__('Bejelentkezés')}}</a>
          @endauth
        </div>
      </div>
    </header>
  
    <div class="nav-scroller py-1 mb-2">
      <nav class="nav d-flex justify-content-between">
        <a class="p-2 link-secondary" href="{{route('topic.show',1)}}">Edzés cikkek</a>
        <a class="p-2 link-secondary" href="{{route('topic.show',2)}}">Táplálkozás</a>
        <a class="p-2 link-secondary" href="{{route('topic.show',3)}}">Edzők</a>
        <a class="p-2 link-secondary" href="{{route('topic.show',4)}}">Edzőtermek</a>
      </nav>
    </div>
</div>