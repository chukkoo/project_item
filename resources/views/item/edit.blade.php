<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>商品編集ページ</title>
</head>
<body>
    <h1>商品編集ページ</h1>
    <form action="{{ url('item/edit/'. $item->id) }}" method="post">
        @csrf
        <div>
            <label>商品名</label>
        </div>
        <div>
            <input type="text" name="name" value="{{ $item->name }}" placeholder="商品名を入力">
            @error('name')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label>価格</label>
        </div>
        <div>
            <input type="number" name="price" value="{{ $item->price }}" placeholder="価格を入力">
            @error('price')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label>カテゴリ名</label>
        </div>
        <div>
            <select name="category_id">
                <!-- カテゴリ一覧から選択できるようする -->
                @foreach ($categories as $category)
                    <!-- if文を利用して現在登録しているカテゴリを判別 -->
                    @if ($category->id === $item->category_id)
                        <!-- 登録されているカテゴリの場合にselected属性を付与 -->
                        <option value="{{ $category->id }}" selected>
                            {{ $category->name }}
                        </option>
                    @else
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endif
                @endforeach
            </select>
            @error('category_id')
                <div>{{ $message }}</div>	
            @enderror
        </div>
        <div>
            <input type="submit" name="send" value="更新">
        </div>
        <div>
            <a href="{{ url('item') }}">戻る</a>
        </div>
    </form>
</body>
</html>