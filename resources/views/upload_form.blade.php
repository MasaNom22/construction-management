@extends('app')

@section('title', '画像投稿画面')

@section('content')

@if (count($errors) > 0)
<div class="alert alert-danger">
	<ul>
		@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>
</div>
@endif
<form 	method="post" action="{{ route('upload_image') }}" enctype="multipart/form-data">

	@csrf
	<div class="form-group row">
		<label for="title" class="col-md-4 col-form-label text-md-right">{{ __('建築現場名') }}</label>
		<div class="col-md-6">
			<input type="text" name="title" id="title" />
		</div>
	</div>
	<div class="form-group row">
		<label for="content" class="col-md-4 col-form-label text-md-right">{{ __('作業内容') }}</label>
		<div class="col-md-6">
			<input type="text" name="content" id="content" />
		</div>
	</div>
	<input type="file" name="image" accept="image/png, image/jpeg" />

	<input type="submit" value="建築現場の写真を保存する">
</form>

@endsection