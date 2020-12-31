@extends('app')

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
<form 
	method="post"
	action="{{ route('upload_image') }}"
	enctype="multipart/form-data"
>



	@csrf
	<input type="file" name="image" accept="image/png, image/jpeg" />
		<input type="text" name="title"/>
	<input type="submit" value="Upload">
</form>

@endsection