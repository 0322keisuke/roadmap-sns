@extends('app')

@section('title', 'ロードマップ詳細画面')

@section('content')
@include('nav')
<div class="container">
  <div class="row">
    <div class="col-12">
      <div class="card mt-3">
        <div class="card-body pt-0">
          <div class="card-text">
            @include('roadmaps.form')
            @auth
            <roadmap-copy-all></roadmap-copy-all>
            @endauth
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection