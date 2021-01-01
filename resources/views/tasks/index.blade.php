@extends('app')

@section('content')

<div class=container>
    <div class=row>
        <div class="list-group">
        @foreach($images as $image)
        <a href="{{ route('tasks.index', ['id' => $image->id]) }}" class="list-group-item">
                {{ $image->title }}
                {{ $image->content }}
              </a>
        @endforeach
        </div>
    </div>
</div>

@endsection