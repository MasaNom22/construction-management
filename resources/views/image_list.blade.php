@extends('app')

@section('content')

<hr />
<div class=container>
    <div class=row>
        @foreach($images as $image)
        <div style="float:left;" class="col-md-6">
            <p>{{ $image->title }}</p>
	        <p>{{ $image->content }}</p>
	                    {{-- タスクリストへのリンク --}}
            <a class="" href="{{ route('tasks.index',$image->id) }}">タスク投稿</a>
	        <img src="{{ Storage::url($image->file_path) }}" style="width:100%;"　alt="建設現場の写真"/>
	        <!--<p>{{ $image->file_name }}</p>-->

	        {{-- メッセージ削除フォーム --}}
            {!! Form::model($image, ['route' => ['delete_image', $image->id], 'method' => 'delete']) !!}
                {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
        </div>
        @endforeach
    </div>
</div>
@endsection