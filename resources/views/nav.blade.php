<nav class="navbar navbar-expand-sm navbar-dark teal accent-4">

  <a class="navbar-brand" href="/"><i class="fas fa-map-signs mr-1"></i></i>RoadmapSNS</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="ナビゲーションの切替">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbar">
    <ul class="navbar-nav ml-auto">

      @guest
      <li class="nav-item">
        <a class="nav-link" href="{{ route('register') }}">アカウント登録</a>
      </li>
      @endguest

      @guest
      <li class="nav-item">
        <a class="nav-link" href="{{ route('login') }}">ログイン</a>
      </li>
      @endguest

      @auth
      <li class="nav-item">
        <a class="nav-link" href="{{ route('roadmaps.create') }}"><i class="fas fa-pen mr-1"></i>投稿する</a>
      </li>
      @endauth

      @auth
      <li class="nav-item">
        <a class="nav-link" href="{{ route('tutorials.index') }}"><i class="fab fa-trello mr-1"></i>学習中の教材</a>
      </li>
      @endauth
      @auth
      <!-- Dropdown -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user-circle"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
          <button class="dropdown-item" type="button" onclick="location.href='{{ route("users.show",["name" => Auth::user()->name]) }} '">
            マイページ
          </button>
          <div class="dropdown-divider"></div>
          <button form="logout-button" class="dropdown-item" type="submit">
            ログアウト
          </button>
        </div>
      </li>
      <form id="logout-button" method="POST" action="{{ route('logout') }}">
        @csrf
      </form>
      <!-- Dropdown -->
      @endauth

    </ul>
  </div>
</nav>