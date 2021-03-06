@extends('layouts.app')

@section('title', 'タスク追加画面')

@section('styles')
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <link rel="stylesheet" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">
@endsection

@section('content')
  <div class="container">
    <div class="row">
      <div class="col col-md-offset-3 col-md-6">
        <div>
            <p><span class="badge badge-primary">選択中</span>
                {{ $image->title }}
                {{ $image->content }}
                </p>
          </div>
        <nav class="panel panel-default">
          <div class="panel-heading mb-3">タスクを追加する</div>
          <div class="panel-body">
            @if($errors->any())
              <div class="alert alert-danger">
                @foreach($errors->all() as $message)
                  <p>{{ $message }}</p>
                @endforeach
              </div>
            @endif
            <form action="{{ route('tasks.create', ['id' => $image_id]) }}" method="POST">
              @csrf
              <div class="form-group">
                <label for="title">タイトル</label>
                <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}" />
              </div>
              <div class="form-group">
                <label for="content">内容</label>
                <input type="text" class="form-control" name="content" id="content" value="{{ old('content') }}" />
              </div>
              <div class="form-group">
                <label for="tags">タグ(#から入力してください)</label>
                <input type="text" class="form-control" name="tags" id="tags" placeholder="#タグ名" value="{{ old('tags') }}" />
              </div>
              <div class="form-group">
                <label for="due_day">期限</label>
                <input type="text" class="form-control" name="due_day" id="due_day" value="{{ old('due_day') }}" />
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

@section('scripts')
  <script src="https://npmcdn.com/flatpickr/dist/flatpickr.min.js"></script>
  <script src="https://npmcdn.com/flatpickr/dist/l10n/ja.js"></script>
  <script>
    flatpickr(document.getElementById('due_day'), {
      locale: 'ja',
      dateFormat: "Y/m/d",
      minDate: new Date()
    });
  </script>
@endsection