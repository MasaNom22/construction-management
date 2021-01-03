@extends('app')

@section('content')

<div class=container>
    <div class=row>
        <div class="list-group col-md-3">
          <div>
                {{ $picture_id->title }}
                {{ $picture_id->content }}
          </div>
        @foreach($images as $image)
        <a href="{{ route('tasks.index', ['id' => $image->id]) }}" class="list-group-item">
                {{ $image->title }}
                {{ $image->content }}
              </a>
        @endforeach
        </div>


<div class="column col-md-9">
        <div class="panel panel-default">
  <div class="panel-heading">タスク</div>
  <div class="panel-body">
    <div class="text-right">
      <a href="{{ route('tasks.create', ['id' => $current_folder_id]) }}" class="btn btn-default btn-block">
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
          <div class=col-md-2>
          <td><a href="{{ route('tasks.edit', ['id' => $task->upload_image_id, 'task_id' => $task->id]) }}">編集</a></td>

          {{-- タスク削除フォーム --}}
          <td>{!! Form::model($task, ['route' => ['tasks.destroy', $task->upload_image_id ,$task->id], 'method' => 'delete']) !!}
              {!! Form::submit('削除', ['class' => 'btn btn-danger btn-sm']) !!}
          {!! Form::close() !!}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
</div>

    </div>
</div>

@endsection