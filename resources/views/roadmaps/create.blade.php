@extends('app')

@section('title', 'ロードマップ投稿画面')

@section('content')
@include('nav')
<div class="container">
  <div class="row">
    <div class="col-12">
      <div class="card mt-3">
        <div class="card-body pt-0">
          @include('error_card_list')
          <div class="card-text">
            <form method="POST" action="{{ route('roadmaps.store') }}">
              @include('roadmaps.form')
              <button type="submit" class="btn teal accent-4 btn-block text-white">投稿する</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection