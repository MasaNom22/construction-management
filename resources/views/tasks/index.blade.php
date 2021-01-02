@extends('app')

@section('content')

<div class=container>
    <div class=row>
        <div class="list-group col-md-4">
        @foreach($images as $image)
        <a href="{{ route('tasks.index', ['id' => $image->id]) }}" class="list-group-item">
                {{ $image->title }}
                {{ $image->content }}
              </a>
        @endforeach
                {{ $picture_id->title }}
                {{ $picture_id->content }}
        </div>


<div class="column col-md-8">
        <div class="panel panel-default">
  <div class="panel-heading">タスク</div>
  <div class="panel-body">
    <div class="text-right">
      <a href="#" class="btn btn-default btn-block">
        タスクを追加する
      </a>
    </div>
  </div>
  <table class="table">
    <thead>
    <tr>
      <th>タイトル</th>
      <th>内容</th>
      <th>状態</th>
      <th>期限</th>
      <th></th>
    </tr>
    </thead>
    <tbody>
      @foreach($tasks as $task)
        <tr>
          <td>{{ $task->title }}</td>
          <td>{{ $task->content }}</td>
          <td>
            <span class="label {{ $task->status_class }}">{{ $task->status_label }}</span>
          </td>
          <td>{{ $task->formatted_due_day }}</td>
          <td><a href="#">編集</a></td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
</div>

    </div>
</div>

@endsection