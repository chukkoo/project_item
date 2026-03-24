<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>管理者編集ページ</title>
</head>
<body>
    <h1>管理者編集ページ</h1>
    <form action="{{ url('admin/edit/'. $admin->id) }}" method="post">
        @csrf
        <div>
            <label>管理者名</label>
        </div>
        <div>
            <input type="text" name="name" value="{{ $admin->name }}" placeholder="管理者名を入力">
        </div>
        <div>
            <input type="submit" name="send" value="更新">
        </div>
        <div>
            <a href="{{ url('admin') }}">戻る</a>
        </div>
    </form>
</body>
</html>