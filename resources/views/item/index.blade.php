<!-- main.blade.phpの継承 -->
@extends('layouts.main')

<!-- main.blade.php @yield('title')への値受け渡し -->
@section('title', '商品一覧')

<!-- header.blade.php の読み込み -->
@include('layouts.header')

<!-- sidebar.blade.php の読み込み -->
@include('layouts.sidebar')

<!-- 'contents'という名称で他のBladeからの呼び出しを可能にする -->
@section('contents')
<h1>商品一覧表示ページ</h1>
<h2>商品検索</h2>
<form action="{{ url('item') }}" method="get">
    <div>
        <input class="input-border" type="text" name="name" placeholder="商品名">
        <input class="input-border" type="text" name="price" placeholder="値段">
        <button class="search-btn" type="submit">検索</button>
    </div>
</form>

<h2>商品一覧</h2>
    <table class="tbl">
        <thead>
            <tr>
                <th>id</th>
                <th>商品名</th>
                <th>価格</th>
                <th>在庫数</th>
                <th>カテゴリ</th>
                <th class="tbl-stock">入出荷</th>
                <th><!-- 編集ボタン --></th>
                <th><!-- 削除ボタン --></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $key => $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ number_format($item->price) }}</td>
                    <td>{{ $item->stock }}</td>
                    <td>{{ $item->category->name }}</td>
                    <td>
                        <form action="{{ url('item/stock/'. $item->id) }}" method="post">
                            @csrf
                            <input
                                type="number"
                                class="input-border"
                                name="stock[{{$key}}]"
                                value={{ old("stock.$key") }}
                            >
                            <input class="tbl-stock-btn" type="submit" name="in" value="入荷">
                            <input class="tbl-stock-btn" type="submit" name="out" value="出荷">
                        </form>
                        @error('stock.'.$key)
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </td>
                    <td class="action">
                        <form action="{{ url('item/edit/'. $item->id) }}" method="get">
                            <input class="tbl-btn edit" type="submit" value="編集">
                        </form>
                        <form action="{{ url('item/delete/'. $item->id) }}" method="post">
                            @csrf
                            <input class="tbl-btn delete" type="submit" value="削除">
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection