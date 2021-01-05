@extends('app')

@section('title', 'トップページ')

@section('content')

<div class=container>
    <div class=row>
        @foreach($images as $image)
        <div style="" class="col-md-6 mt-4 mb-4">
            <h4>現場名: {{ $image->title }}</h4>
	        <h5>リフォーム内容: {{ $image->content }}</h5>
	                    {{-- タスクリストへのリンク --}}
            <a class="" href="{{ route('tasks.index',$image->id) }}">タスク一覧画面へ</a>
            <div class="mx-2">
	        <img src="{{ Storage::url($image->file_path) }}" style="width:100%;"　alt="建設現場の写真"/>
	        </div>
	        <!--<p>{{ $image->file_name }}</p>-->

	        {{-- メッセージ削除フォーム --}}
            {!! Form::model($image, ['route' => ['delete_image', $image->id], 'method' => 'delete']) !!}
                {!! Form::submit('画像削除', ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
            <a href="{{ route('image.edit', ['id' => $image->id]) }}">編集</a>
        </div>
        @endforeach
    </div>
</div>
@endsection