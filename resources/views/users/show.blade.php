@extends('app')

@section('title', $user->name)

@section('content')
@include('nav')
<div class="container">
  @include('users.user')
  @include('users.tabs',['hasRoadmaps' => true,'hasLikes' => false])
  @foreach($roadmaps as $roadmap)
  @include('roadmaps.card')
  @endforeach
</div>
@endsection