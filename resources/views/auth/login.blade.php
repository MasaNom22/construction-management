@extends('app')

@section('title', 'ログイン画面')

@section('content')
  <div class="container">
    <div class="row">
      <div class="mx-auto col col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6">
        <div class="card mt-3">
          <div class="card-body text-center">
            <h2 class="h3 card-title text-center mt-2">ログイン</h2>
            
            <div class="card-text">
              <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="md-form">
                  <label for="email">メールアドレス</label>
                  <input class="form-control" type="text" id="email" name="email" required value="{{ old('email') }}">
                </div>

                <div class="md-form">
                  <label for="password">パスワード</label>
                  <input class="form-control" type="password" id="password" name="password" required>
                </div>
 
                <input type="hidden" name="remember" id="remember" value="on">

                <button class="btn aqua-gradient mt-2 mb-2" type="submit">ログイン</button>
                <a class="btn aqua-gradient" href="{{ route('login.guest') }}">ゲストログイン</a>
              </form>
                <h5 class="mt-2 text-dark">ゲストログインボタンからお入りください</h5>
              <div class="mt-0">
                <a href="{{ route('signup.get') }}" class="card-text">ユーザー登録はこちら</a>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection