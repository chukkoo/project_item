@section('header')
<header class="header">
    <div class="header-inner">
        <div class="logo">
            <h1>
                <small>商品管理システム</small>
                STOCKS!
            </h1>
        </div>
        <nav class="login-user">
            <a href="{{ url('profile') }}">
                <li>{{ Auth::user()->name }}</li>
            </a>
            <form action="{{ url('logout') }}" method="post">
                @csrf
                <input
                    class="link-style-btn"
                    type="submit"
                    name="logout"
                    value="ログアウト"
                />
            </form>
        </nav>
    </div>
</header>
@endsection