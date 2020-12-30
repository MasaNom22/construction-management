<header class="mb-4">
    <nav class="navbar navbar-expand-sm navbar-dark blue-gradient">
        {{-- トップページへのリンク --}}
        <a class="navbar-brand" href="/"><i class="fas fa-archway mr-1"></i>Construction-management</a>

        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="nav-bar">
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav">
                {{-- ユーザ登録ページへのリンク --}}
                <li>{!! link_to_route('signup.get', '新規登録', [], ['class' => 'nav-link']) !!}</li>
                {{-- ログインページへのリンク --}}
                <li><a href="#">ログイン</a></li>
            </ul>
        </div>
    </nav>
</header>