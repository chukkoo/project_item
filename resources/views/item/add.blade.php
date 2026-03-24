@extends('layouts.main')
@section('title', '商品一覧')
@include('layouts.header')
@include('layouts.sidebar')

@section('contents')
    <h1>商品新規登録ページ</h1>
    <!-- 登録処理のHTTPメソッドはPOSTに -->
    <!-- actionはurl関数を利用する -->
    <form action="{{ url('item/add') }}" method="post">
        <!-- POST通信なので@csrfディレクティブを用意 -->
        @csrf
        <div>
            <label>商品名</label>
        </div>
        <div>
            <!-- value属性にold('name')と記述することで登録ボタンクリック後でも元々入力していた値の再表示が可能 -->
            <input
                type="text" 
                name="name" 
                value="{{ old('name') }}" 
                placeholder="商品名を入力してください">
            {{-- HTMLには表示されないコメントアウト（通常のコメントアウトでは@errorのような記述はエラーとなる） --}}
            {{-- @error('name')内の$messageは入力エラーがあった場合に表示 --}}
            @error('name')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label>価格</label>
        </div>
        <div>
            <!-- 価格はnumberに -->
            <input type="number" name="price" placeholder="価格を入力してください">
        </div>
        <div>
                <label>カテゴリ名</label>
        </div>
        <div>
            <select name="category_id">
                <!-- カテゴリ一覧から選択できるようする -->
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <input type="submit" name="send" value="登録">
        </div>
        <div>
            <!-- 一覧に戻る -->
            <a href="{{ url('item') }}">戻る</a>
        </div>
    </form>
@endsection