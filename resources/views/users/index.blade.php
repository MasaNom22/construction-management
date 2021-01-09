@extends('app')

@section('title', '下請け検索画面')

@section('content')

<div class=container>
    <div class=row>
        <div class="list-group col-md-4">
            <h4>検索条件を入力してください</h4>
            <form action="{{ url('/users')}}" method="get">
              {{ csrf_field()}}
              {{method_field('get')}}
                <div class="form-group">
                    <label>名前</label>
                    <input type="text" class="form-control" placeholder="検索したい名前を入力してください" name="name" value="">
                </div>
                <button type="submit" class="btn btn-primary col-md-5">検索</button>
            </form>
        </div>
        @if(session('flash_message'))
        <div class="alert alert-primary" role="alert" style="margin-top:50px;">{{ session('flash_message')}}</div>
            @endif
            <div class="column col-md-8">
                <div style="margin-top:50px;">
                    <h1>下請け一覧</h1>
                    <li class="nav-item">{!! link_to_route('signup.get2', '新規登録', [], ['class' => 'nav-link']) !!}</li>
                        <table class="table">
                            <tr>
                                <th>業者名</th>
                            </tr>
                            @foreach($users as $user)
                            <tr>
                                <td>{{$user->name}}</td>
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