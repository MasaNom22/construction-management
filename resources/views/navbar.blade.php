<header class="mb-4">
    <nav class="navbar navbar-expand-sm navbar-dark aqua-gradient">
        {{-- トップページへのリンク --}}
        <a class="navbar-brand" href="/"><i class="fas fa-archway mr-1"></i>施工管理支援ツール</a>

        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="nav-bar">
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav">
                @if (Auth::check())
                    <li class="nav-item">
                        <span class="nav-link">ようこそ、 {{ Auth::user()->name }}さん</span>
                    </li>
                    {{-- 全体連絡ページへのリンク --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('chats.index') }}"><i class="fas fa-bell mr-1"></i>全体連絡</a>
                    </li>
                    {{-- 業者登録ページへのリンク --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('users.index') }}"><i class="fas fa-user-plus mr-1"></i>下請業者検索</a>
                    </li>
                    {{-- 画像投稿ページへのリンク --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('upload_form') }}"><i class="fas fa-arrow-alt-circle-down mr-1"></i>現場写真投稿</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="" class="nav-link dropdown-toggle" data-toggle="dropdown">{{ '機能一覧' }}</a>
                        <ul class="dropdown-menu dropdown-menu-right">
                    {{-- 画像一覧ページへのリンク --}}
                    <li class="dropdown-item">
                        {!! link_to_route('image_list', '画像確認') !!}
                    </li>
                    
                    {{-- ログアウトへのリンク --}}
                    <li class="dropdown-item">
                        {!! link_to_route('logout.get', 'ログアウト') !!}
                    </li>
                </ul>
            </li>
                    
                @else
                    {{-- ゲストログインへのリンク --}}
                    <li class="nav-item">{!! link_to_route('login.guest', 'ゲストログイン', [], ['class' => 'nav-link']) !!}</li>
                    {{-- チャットページへのリンク --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('chats.index') }}"><i class="fas fa-bell mr-1"></i>全体連絡</a>
                    </li>
                    {{-- 業者登録ページへのリンク --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('users.index') }}"><i class="fas fa-user-plus mr-1"></i>下請業者検索</a>
                    </li>
                    {{-- 画像投稿ページへのリンク --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('upload_form') }}"><i class="fas fa-arrow-alt-circle-down mr-1"></i>現場写真投稿</a>
                    </li>
                    {{-- 画像一覧ページへのリンク --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('image_list') }}"><i class="fas fa-book-reader mr-1"></i>画像確認</a>
                    </li>
                    {{-- ユーザ登録ページへのリンク --}}
                    <li class="nav-item">{!! link_to_route('signup.get', '新規登録', [], ['class' => 'nav-link']) !!}</li>
                    {{-- ログインページへのリンク --}}
                    <li class="nav-item">{!! link_to_route('login', 'ログイン', [], ['class' => 'nav-link']) !!}</li>
                @endif
            </ul>
        </div>
    </nav>
</header>