@extends('app')

@section('title', 'アカウントを新規作成')

@section('content')
<div class="container">
  <a class="navbar-brand teal accent-4 text-white p-2 rounded-pill" href="/"><i class="fas fa-map-signs mr-1"></i>RoadmapSNS</a>
  <div class="row">
    <div class="mx-auto col col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6">
      <h1 class="text-center"><a class="text-dark" href="/">RoadmapSNS</a></h1>
      <div class="card mt-3">
        <div class="card-body text-center">
          <h2 class="h3 card-title text-center mt-2">アカウントを新規作成</h2>

          @include('error_card_list')

          <div class="card-text">
            <form method="POST" action="{{ route('register') }}">
              @csrf
              <div class="md-form">
                <label for="name">ユーザー名</label>
                <input class="form-control" type="text" id="name" name="name" required value="{{ old('name') }}">
                <small>英数字3〜16文字(登録後の変更はできません)</small>
              </div>
              <div class="md-form">
                <label for="email">メールアドレス</label>
                <input class="form-control" type="text" id="email" name="email" required value="{{ old('email') }}">
              </div>
              <div class="md-form">
                <label for="password">パスワード</label>
                <input class="form-control" type="password" id="password" name="password" required>
              </div>
              <div class="md-form">
                <label for="password_confirmation">パスワード(確認)</label>
                <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" required>
              </div>
              <button class="btn btn-block teal accent-4 text-white font-weight-bold mt-2 mb-2" type="submit">アカウントを新規作成</button>
            </form>

            <div class="mt-0">
              <a href="{{ route('login') }}" class="card-text">ログインはこちら</a>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection