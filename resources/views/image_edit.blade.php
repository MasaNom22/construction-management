@extends('layouts.app')

@section('title', '画像編集画面')

@section('content')

<div class=container>
    <div class=row>
        <form
        action="{{ route('image.edit', ['id' => $image->id]) }}"
                method="POST"
        >
        @csrf
            <div class="form-group">
                <label for="title">現場名</label>
                <input type="text" class="form-control" name="title" id="title"
                       value="{{ old('title') ?? $image->title }}" />
            </div>
            <div class="form-group">
                <label for="title">施工内容</label>
                <input type="text" class="form-control" name="content" id="content"
                       value="{{ old('content') ?? $image->content }}" />
             </div>
	        <div class="text-right">
                <button type="submit" class="btn btn-primary">変更</button>
             </div>
            <div class="mx-2">
                <img src="{{ Storage::url($image->file_path) }}" style="width:100%;" alt="建設現場の写真"/>
	            {{-- <img src="{{ Storage::disk('s3')->url($image->file_path) }}" style="width:100%;" alt="建設現場の写真"/> --}}
	        </div>
	        </form>
	</div>
</div>
	        
	        @endsection