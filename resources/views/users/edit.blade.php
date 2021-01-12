@extends('app')

@section('title', '業者編集画面')

@section('content')

<div class="container">
    <div class="row">
      <div class="col col-md-offset-3 col-md-6">
        <nav class="panel panel-default">
          <div class="panel-heading mb-3">業者情報を編集する</div>
          <div class="panel-body">
            @if($errors->any())
              <div class="alert alert-danger">
                @foreach($errors->all() as $message)
                  <p>{{ $message }}</p>
                @endforeach
              </div>
            @endif
            <form
                action="{{ route('users.edit', ['id' => $user->id]) }}"
                method="POST"
            >
              @csrf
              <div class="form-group">
                <label for="name">名前</label>
                <input type="text" class="form-control" name="name" id="name"
                       value="{{ old('name') ?? $user->name }}" />
              </div>
              <div class="form-group">
                <label for="email">メールアドレス</label>
                <input type="text" class="form-control" name="email" id="email"
                       value="{{ old('email') ?? $user->email }}" />
              </div>
              <div class="text-right">
                <button type="submit" class="btn btn-primary">送信</button>
              </div>
            </form>
          </div>
        </nav>
      </div>
    </div>
  </div>

@endsection