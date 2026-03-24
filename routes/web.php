<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApiController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// 商品管理システムにアクセスした時はログインページを表示
Route::get('/', function () {
    return view('auth.login');
});

// ログイン認証がされている状態の時のみ
Route::middleware('auth')->group(function () {
    // ユーザー情報編集ページ表示
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // ユーザー情報更新
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // ユーザー情報削除
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 商品一覧の表示
    Route::get('/item', [ItemController::class, 'index']);
    // 商品登録ページ
    Route::get('/item/add', [ItemController::class, 'showAdd']);
    // 商品登録の実行
    Route::post('/item/add', [ItemController::class, 'add']);
    // 商品編集ページ
    Route::get('/item/edit/{id}', [ItemController::class, 'showEdit']);
    // 商品編集の実行
    Route::post('/item/edit/{id}', [ItemController::class, 'edit']);
    // 商品の削除実行
    Route::post('/item/delete/{id}', [ItemController::class, 'delete']);
    // 在庫管理用のルーティング
    Route::post('/item/stock/{id}', [ItemController::class, 'editStock']);
    //認証済みユーザの詳細情報
    Route::get('/detail', [ItemController::class, 'detail']);
    //ヘッダー、サイドバー追加後のadmin
    Route::get('/admin', [AdminController::class, 'index']);

});

// 認証ブロックの外に記述する
Route::get('/list', [ApiController::class, 'list']);
// 認証ブロックの外に記述する
Route::post('/create', [ApiController::class, 'create']);
// 認証ブロックの外に記述する
Route::get('/token', [ApiController::class, 'token']);

require __DIR__.'/auth.php';