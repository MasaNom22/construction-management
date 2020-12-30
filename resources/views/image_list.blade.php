@extends('app')

@section('content')

<a href="{{ route('upload_form') }}">Upload</a>
<hr />

@foreach($images as $image)
<div style="width: 18rem; float:left; margin: 16px;">
	<img src="{{ Storage::url($image->file_path) }}" style="width:100%;"/>
	<p>{{ $image->file_name }}</p>
</div>
@endforeach

@endsection