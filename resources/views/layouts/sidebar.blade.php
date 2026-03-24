<!-- 'sidebar'という名称で他のBladeからの呼び出しを可能にする -->
@section('sidebar')
<div class="sidebar">
    <h2>管理メニュー</h2>
    <ul class="menu-list">
        <li><a href="{{ url('item') }}">商品一覧</a></li>
        <li><a href="{{ url('item/add') }}">商品新規登録</a></li>
        <li><a href="{{ url('admin') }}">管理者一覧</a></li>
    </ul>
</div>
@endsection