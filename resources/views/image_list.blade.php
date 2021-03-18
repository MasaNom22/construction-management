@extends('app')

@section('title', 'トップページ')

@section('content')

<div class=container>
    <div class=row>
        @if(count($images) == 0)
        <div class="">
	        <a class="btn btn-success" href="{!! route('upload_form') !!}">画像登録</a>
        </div>
        @else
        @foreach($images as $image)
        <div style="" class="col-md-6 mt-4 mb-4">
            <h4>現場名: {{ $image->title }}</h4>
	        <h5>施工内容: {{ $image->content }}</h5>
	        <h5>管理者名: {{ $image->user->name }}</h5>
	                    {{-- タスクリストへのリンク --}}
            <!--<a class="" href="{{ route('tasks.index',$image->id) }}">タスク一覧画面へ</a>-->
            <a class="btn btn-success" href="{{ route('tasks.index',$image->id) }}">タスク登録画面へ</a>
            <div class="mx-2">
	            <img src="{{ Storage::disk('s3')->url($image->file_path) }}" style="width:100%;"　alt="建設現場の写真"/>
	            <!--<p>{{ $image->file_name }}</p>-->
    	        <div class="d-flex flex-row .justify-content-between p-2 bd-highlight ">
        	        <div class="d-inline-flex col-md-6">
                        <!--<a href="{{ route('image.edit', ['id' => $image->id]) }}">編集</a>-->
                        <a class="btn btn-success" href="{{ route('image.edit', ['id' => $image->id]) }}">編集</a>
                    </div>
                    <div class="d-inline-flex col-md-6">
            	        {{-- メッセージ削除フォーム --}}
                        <!--{!! Form::model($image, ['route' => ['delete_image', $image->id], 'method' => 'delete']) !!}-->
                        <!--    {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}-->
                        <!--{!! Form::close() !!}-->
                        <a class="btn btn-danger" data-toggle="modal" data-target="#modal-delete-{{  $image->id }}">
                          <i class="fas fa-trash-alt mr-1"></i>削除
                        </a>
                        
                        <div id="modal-delete-{{ $image->id }}" class="modal fade" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                    <form method="POST" action="{{ route('delete_image', ['id' => $image->id]) }}">
                                      @csrf
                                      @method('DELETE')
                                      <div class="modal-body">
                                        {{ $image->title }}の現場画像を削除します。よろしいですか？
                                      </div>
                                      <div class="modal-footer justify-content-between">
                                        <a class="btn btn-outline-grey" data-dismiss="modal">キャンセル</a>
                                        <button type="submit" class="btn btn-danger">削除する</button>
                                      </div>
                                    </form>
                                </div>
                        </div>
                      </div>
                      <!-- modal -->
          
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @endif
    </div>
</div>
@endsection