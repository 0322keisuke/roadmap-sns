@extends('app')

@section('title', $user->name . 'のいいねしたロードマップ')

@section('content')
@include('nav')
<div class="container">
  @include('users.user')
  @include('users.tabs',['hasRoadmaps' => false,'hasLikes' => true])
  @foreach($roadmaps as $roadmap)
  @include('roadmaps.card')
  @endforeach
</div>
@endsection