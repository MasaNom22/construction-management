@extends('app')

@section('content')

<hr />
<div class=container>
    <div class=row>
    @foreach($images as $image)
    <div style="float:left;" class="col-md-6">
	    <img src="{{ Storage::url($image->file_path) }}" style="width:100%;"/>
	    <!--<p>{{ $image->file_name }}</p>-->
	    <p>{{ $image->title }}</p>
	            {{-- メッセージ削除フォーム --}}
        {!! Form::model($image, ['route' => ['delete_image', $image->id], 'method' => 'delete']) !!}
            {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
        {!! Form::close() !!}
    </div>

    @endforeach
    </div>
</div>
@endsection