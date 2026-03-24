<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>認証済みユーザー詳細</title>
</head>
<body>
    <h1>認証済みユーザー詳細</h1>
    <div>id: {{ Auth::user()->id }}</div>
    <div>name: {{ Auth::user()->name }}</div>
    <div>email: {{ Auth::user()->email }}</div>
</body>
</html>