@extends('layouts.app')

@section('title', 'チャット画面')

@section('content')
<div class="chat-container row justify-content-center">
    <div class="chat-area">
        <div class="card">
            <div class="card-header">コメント</div>
            <div class="card-body chat-card">
                <div id="comment-data"></div>
            </div>
        </div>
    </div>
</div>
<form method="POST" action="{{route('chats.post')}}">
    @csrf
    <div class="comment-container row justify-content-center">
        <div class="input-group comment-area">
            <textarea class="form-control" id="comment" name="comment" placeholder="push massage (shift + Enter)"
                aria-label="With textarea"
                onkeydown="if(event.shiftKey&&event.keyCode==13){document.getElementById('submit').click();return false};"></textarea>
            <button type="submit" id="submit" class="btn btn-outline-primary comment-btn">送信</button>
        </div>
    </div>
</form>
{{-- 投稿削除フォーム --}}
        <form action="{{route('chats.destroy')}}" method="post" class="float-right">
            @csrf
                @method('delete')
                <input type="submit" value="全削除" class="btn btn-danger" onclick='return confirm("削除しますか？");'>
                </div>
        </form>
            
@endsection
@section('js')
<script src="{{ asset('js/comment.js') }}" defer></script>
@endsection
