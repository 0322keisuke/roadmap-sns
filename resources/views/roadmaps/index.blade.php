@extends('app')

@section('title', 'ロードマップ一覧')

@section('content')
  @include('nav')
  <div class="container">
    <div class="card-deck mt-3">
      @foreach($roadmaps as $roadmap)
      <div class="col-md-6 mb-3">
      <div class="card h-100">
        <div class="card-body d-flex flex-row">
          <i class="fas fa-user-circle fa-3x mr-1"></i>
          <div>
            <div class="font-weight-bold">
              {{ $roadmap->user->name }}
            </div>
            <div class="font-weight-lighter">
              {{ $roadmap->created_at->format('Y/m/d H:i') }}
            </div>
          </div>
        </div>
        <div class="card-body pt-0 pb-2">
          <h3 class="h4 card-title">
            {{ $roadmap->title }}
          </h3>
          <div class="card-text">
            <div class="estimated-time mr-1"> 
              <i class="far fa-clock"></i>
              <span>{{ $roadmap->estimated_time }}h</span>
            </div>
          </div>
        </div>
        <div class="card-body pt-0 pb-2 pl-3">
          <div class="card-text">
            <roadmap-like
            :initial-is-liked-by='@json($roadmap->isLikedBy(Auth::user()))'
            :initial-count-likes='@json($roadmap->count_likes)'
            >
            </roadmap-like>
          </div>
        </div>
      </div>
      </div>
      @endforeach
    </div>
  </div>
@endsection