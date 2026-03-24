<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <!-- @section('title', '商品一覧')の内容を読み込み -->
    <title>商品管理システム - @yield('title')</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'>
    <meta name="viewport" content="width=device-width">

    <!-- CSS読み込み -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">
    <!-- フォント読み込み -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Muli:400,300" rel="stylesheet" type="text/css">

</head>
<body>
    <!-- @section('header')の内容を読み込み -->
    @yield('header')
    <div class="main">
        <!-- @section('sidebar')の内容を読み込み -->
        @yield('sidebar')
        <!-- @section('contents')の内容を読み込み -->
        <div class="contents">
            @yield('contents')
        </div>
    </div>
    <!-- JS読み込み -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>