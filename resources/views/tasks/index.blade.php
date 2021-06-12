@extends('app')

@section('title', 'タスク管理画面')

@section('content')

<div class=container>
  <div class=row>
    <div class="list-group col-md-4">
      <div>
        <p><span class="badge badge-primary">選択中</span>
          {{ $picture_id->title }}
          {{ $picture_id->content }}
          <span class="badge badge-primary">{{ $picture_id->tasks_count }}</span>
        </p>
      </div>
      @foreach($images as $image)
      <a href="{{ route('tasks.index', ['id' => $image->id]) }}" class="list-group-item">
        {{ $image->title }}
        {{ $image->content }}
      </a>
      @endforeach

      <form action="{{ route('tasks.search', ['id' => $picture_id->id]) }}" method="get" class="mt-2">
        {{ csrf_field()}}
        {{method_field('get')}}
        <div class="form-group">
          <label>タスク</label>

          <input type="text" class="form-control" placeholder="検索したいタスクのタイトルを入力して下さい" name="title"
            value="{{ old('title') }}">
          <div class="form-group">
            {!! Form::label('status', 'ステータス') !!}
            {!! Form::select('status', [null => 'すべて', '1' => '未着手', '2' => '着手中', '3' => '完了'], $status, ['class' =>
            'form-control custom-select']) !!}
          </div>
          <button type="submit" class="btn btn-primary col-md-4">検索</button>
        </div>
      </form>
    </div>


    <div class="column col-md-8">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h2 class="ml-3">タスク</h2>
        </div>

        <div class="panel-body">
          @if($picture_id->tasks_count >0)
          {!! Form::model($picture_id, ['route' => ['tasks.statusedit', $picture_id->id], 'method' => 'put']) !!}
          {!! Form::submit('タスク一括完了', ['class' => 'btn btn-success btn-sm']) !!}
          {!! Form::close() !!}
          @else
          @endif
          <div class="text-right">
            <a href="{{ route('tasks.create', ['id' => $current_image_id]) }}"
              class="btn btn-success fa fa-check-circle">
              タスクを追加する
            </a>
          </div>
        </div>
        <table class="table">
          <thead>
            <tr>
              <th>タイトル</th>
              <th>内容</th>
              <th>タグ</th>
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
                @foreach($task->tags as $task_tag)
                <span class="badge badge-pill badge-info">{{$task_tag->name}}</span>
                @endforeach
              </td>
              <td>
                <span class="label {{ $task->status_class }}">{{ $task->status_label }}</span>
              </td>
              <td>{{ $task->formatted_due_day }}</td>
              <div class=col-md-2>
                <!--<td><a href="{{ route('tasks.edit', ['id' => $task->upload_image_id, 'task_id' => $task->id]) }}">編集</a></td>-->
                <!--<td><a class="btn btn-success btn-sm " href="{{ route('tasks.edit', ['id' => $task->upload_image_id, 'task_id' => $task->id]) }}">編集</a></td>-->
                {{-- タスク編集フォーム --}}
                <td>{!! Form::model($task, ['route' => ['tasks.edit', $task->upload_image_id ,$task->id], 'method' =>
                  'get']) !!}
                  {!! Form::submit('編集', ['class' => 'btn btn-success btn-sm']) !!}
                  {!! Form::close() !!}</td>
                {{-- タスク削除フォーム --}}
                <td>{!! Form::model($task, ['route' => ['tasks.destroy', $task->upload_image_id ,$task->id], 'method' =>
                  'delete']) !!}
                  {!! Form::submit('削除', ['class' => 'btn btn-danger btn-sm']) !!}
                  {!! Form::close() !!}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
        {{ $tasks->links() }}
      </div>
    </div>
  </div>
</div>

@endsection