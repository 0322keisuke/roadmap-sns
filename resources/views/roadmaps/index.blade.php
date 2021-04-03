@extends('app')

@section('title', 'ロードマップ一覧')

@section('content')
@include('nav')
<div class="container">
  <div class="card-deck mt-3">
    @foreach($roadmaps as $roadmap)
    @include('roadmaps.card')
    @endforeach
  </div>
</div>
@endsection