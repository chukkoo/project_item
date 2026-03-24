<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>管理者登録ページ</title>
</head>
<body>
<h1>管理者新規登録ページ</h1>
<!-- 登録処理のHTTPメソッドはPOSTに -->
<!-- actionはurl関数を利用する -->
<form action="{{ url('admin/add') }}" method="post">
    <!-- POST通信なので@csrfディレクティブを用意 -->
    @csrf
    <div>
        <label>管理者名</label>
    </div>
    <div>
        <!-- 商品名はtextに　name属性はカラム名と合わせるとわかりやすい -->
        <input type="text" name="name" placeholder="管理者名を入力してください">
    </div>
    <div>
        <input type="submit" name="send" value="登録">
    </div>
    <div>
        <!-- 一覧に戻る -->
        <a href="{{ url('admin') }}">戻る</a>
    </div>
</form>
</body>
</html>