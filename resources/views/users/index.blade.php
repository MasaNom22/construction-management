@extends('app')

@section('title', '下請け検索画面')

@section('content')

<div class=container>
    <div class=row>
        <div class="list-group col-md-4">
            <h4>検索条件を入力してください</h4>
            <form action="{{ url('/users')}}" method="get" class="mb-1">
              {{ csrf_field()}}
              {{method_field('get')}}
                <div class="form-group">
                    <label>名前</label>
                    
                    <input type="text" class="form-control" placeholder="検索したい名前を入力してください" name="name" value="">
                </div>
                <button type="submit" class="btn btn-primary col-md-4">検索</button>
                <!--<div class="mt-3"><h6>業者表示数：{{count($users)}}件</h6></div>-->
            </form>
            
                <div id="map" style="height:450px">
	            </div>
	            <script src="{{ asset('/js/result.js') }}"></script>
	            <script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google-map.apikey') }}&callback=initMap" async defer></script>
	            

            
        </div>
        @if(session('flash_message'))
        <div class="alert alert-primary" role="alert" style="margin-top:50px;">{{ session('flash_message')}}</div>
            @endif
            <div class="column col-md-8">
                <div style="margin-top:50px;">
                    <div class="d-inline-flex col-md-4">
                        <h2>下請業者一覧</h2>
                    </div>
                    <div class="d-inline-flex col-md-4">
	                    <!--<button class="btn btn-primary">{!! link_to_route('signup.get2', '下請業者登録', [], ['class' => 'text-white']) !!}</button>-->
	                    <a class="btn btn-primary" href={!! route('signup.get2') !!}>下請業者登録</a>
                    </div>
                    
                        <table class="table">
                            <thead>
                            <tr>
                                <th class="">業者名</th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            @foreach($users as $user)
                            <tr>
                                <td>{{$user->name}}</td>
                                <td></td><td></td>
                                <td></td><td></td>
                                <td></td>
                                {{-- タスク編集フォーム --}}
                                <td>{!! Form::model($user, ['route' => ['users.edit', $user->id], 'method' => 'get']) !!}
                                    {!! Form::submit('編集', ['class' => 'btn btn-success btn-sm']) !!}
                                    {!! Form::close() !!}</td>
                                                    
                                {{-- タスク削除フォーム --}}
                                  <td>{!! Form::model($user, ['route' => ['users.destroy', $user->id], 'method' => 'delete']) !!}
                                      {!! Form::submit('削除', ['class' => 'btn btn-danger btn-sm']) !!}
                                  {!! Form::close() !!}</td>
                            
          
                            </tr>
                            @endforeach
                        </table>
                            {{ $users->links() }}
                            
                </div>
            </div>
        </div>
    </div>
</div>

@endsection