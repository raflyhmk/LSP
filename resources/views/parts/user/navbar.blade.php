<!-- navbar -->

  <nav class="navbar navbar-expand-lg navbar-light bg-transparent mt-2 mb-4 pb-4">
    <div class="container">
      <a class="navbar-brand" href="/">
        MediPrime
      </a>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarNavDropdown"
        aria-controls="navbarNavDropdown"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <div class="navbar-nav mx-auto">
          <a class="nav-link me-4" href="/">Beranda</a>
          <a class="nav-link me-4" href="/medical-supplies">Medical supplies</a>
          <a class="nav-link me-4" href="/history-supplies">History</a>
          <a class="nav-link me-4">Review</a>
        </div>
        @guest
        <button class="btn btn-login my-2 my-sm-0" type="button"
                onclick="event.preventDefault(); location.href='{{ url('login') }}';">
          Login
        </button>
        @endguest
        @if(Auth::check() && Auth::user()->admin === 'False')
        <div class="btn-group">
        <button type="button" class="btn btn-primary btn-profile dropdown-toggle pe-2" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
          <i class="fa-solid fa-user fa-lg me-2"></i>
          {{Auth::user()->name}}
        </button>
        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start">
          <li><button class="dropdown-item" type="button" onclick="event.preventDefault(); location.href='{{ url('profile') }}';">Profile</button></li>
          <li><button class="dropdown-item" type="button" onclick="event.preventDefault(); location.href='{{ url('logout') }}';">Keluar</button></li>
        </ul>
      </div>
        @endauth
      </div>
    </div>
  </nav>


@if(Auth::check() && Auth::user()->admin === 'False')

@endauth
  <!-- end navbar -->