<div class="card-group">
  <div class="card mt-3">
    <div class="card-body">
      <div class="d-flex flex-row">
        <a href="{{ route('users.show', ['name' => $user->name]) }}" class="text-dark">
          <i class="fas fa-user-circle fa-3x"></i>
        </a>
        @if( Auth::id()!== $user->id)
        <follow-button class="ml-5" :initial-is-followed-by='@json($user->isFollowedBy(Auth::user()))' :authorized='@json(Auth::check())' endpoint="{{ route('users.follow', ['name' => $user->name]) }}"></follow-button>
        @endif
      </div>
      <h2 class="h5 card-title m-0">
        <a href="{{ route('users.show', ['name' => $user->name]) }}" class="text-dark">
          {{ $user->name }}
        </a>
      </h2>
    </div>
    <div class="card-body">
      <div class="card-text">
        <a href="{{ route('users.followings',['name' => $user->name])}}" class="text-muted">
          {{ $user->count_followings }} フォロー
        </a>
        <a href="{{ route('users.followers', ['name' => $user->name]) }}" class="text-muted">
          {{ $user->count_followers }} フォロワー
        </a>
      </div>
    </div>
  </div>
  <div class="card mt-3">
    <div class="card-body align-middle">
      <div class="d-flex justify-content-center p-3">
        <i class="fas fa-book fa-3x amber-text"></i>
        <h2 class="text-center m-2 pl-2"> {{ $user->count_done_tutorials }} </h2>
      </div>
      <div class="card-text text-center">
        完了教材数
      </div>
    </div>
  </div>
  <div class="card mt-3">
    <div class="card-body align-middle">
      <div class="d-flex justify-content-center p-3">
        <i class="fas fa-tasks fa-3x green-text"></i>
        <h2 class="text-center m-2 pl-2"> {{ $user->count_done_tasks }} </h2>
      </div>
      <div class="card-text text-center">
        総クリアタスク数
      </div>
    </div>
  </div>
</div>