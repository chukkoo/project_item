<?php
namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
            // 管理者一覧の表示
    public function index()
    {
        // Itemクラスを介してitemsテーブルのデータを全件取得
        $admins = Admin::all();

        // 画面で利用する変数として$itemsを連想配列で渡す
        return view('admin.admins', ['admins' => $admins]);
    }

      // 商品編集ページの表示
    public function showEdit($id)
    {
        // 商品データを1件取得
        $admin = Admin::find($id);

        // 画面で利用する変数として$itemを連想配列で渡す
        return view("admin.edit", ["admin" => $admin]);
    }

        public function showAdd()
    {
        return view('admin.add');
    }
    

    // 商品登録の実行
    public function add(Request $request)
    {
        // フォームに入力した値の確認
        $admin = new Admin;
        
        if ($admin->fill($request->all())->save()) {
            Log::info('管理者の登録が正常に行われました', ['admin_id' => $admin->id]);
            return redirect('/admin');
        }
        Log::error('管理者の登録ができませんでした', ['data' => $request->all()]);
        return redirect('/admin');

        // パラメータを個別に参照する場合は以下のように記述
        // $request->name
        // $request->price
    }

        // 商品編集の実行
    public function edit($id, Request $request)
    {
        // 商品データを1件取得
        $admin = Admin::find($id);

        // リクエストからModelの$fillableに設定したプロパティのみを抽出・保存
        $admin->fill($request->all())->save();

        // http://localhost/item_manager/public/itemにリダイレクト
        return redirect("/admin");
    }

    public function delete($id)
    {
        // 商品データを1件取得
        $admin = Admin::find($id);

        // 削除
        $admin->delete();

        // views\item\index.blade.phpにリダイレクト
        return redirect("/admin");
    }

}