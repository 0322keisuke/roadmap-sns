<ul class="nav nav-tabs nav-justified mt-4">
  <li class="nav-item">
    <a class="nav-link text-muted {{ $hasRoadmaps ? 'active' : '' }}" href="{{ route('users.show', ['name' => $user->name]) }}">
      ロードマップ
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link text-muted {{ $hasLikes ? 'active' : '' }}" href="{{ route('users.likes', ['name' => $user->name]) }}">
      いいね
    </a>
  </li>
</ul>