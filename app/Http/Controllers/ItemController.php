<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Facades\Log;
use App\Models\Category;
// 新規登録フォーム用Requestの追加
use App\Http\Requests\CreateItemRequest;
use App\Http\Requests\EditStockRequest;
use App\Http\Requests\EditItemRequest;
use Illuminate\Validation\ValidationException;

class ItemController extends Controller
{
    // 商品一覧の表示
    // public function index()
    // {
    //     return view('item.index');
    // }

    // 商品一覧の表示
    public function index(Request $request)
    {
        $sql = Item::query()->whereNull("deleted_at");
        $re = $request->all();
        if (!empty($re['name'])) {
            $sql->where('name', $re['name']);
        }
        if (!empty($re['price'])) {
            $sql->where('price', $re['price']);
        }
        $items = $sql->get();
        return view("item.index", ["items" => $items]);
    }

    // 商品登録ページ表示用
    public function showAdd()
    {
        // Categoryモデルから一覧を取得する
        $categories = Category::all();
        // viewにカテゴリを渡す
        return view("item.add", ["categories" => $categories]);
    }

    // 商品登録の実行
    public function add(CreateItemRequest $request)
    {
        $item = new Item;

        if ($item->fill($request->all())->save()) {
            Log::info('商品の登録が正常に行われました', ['item_id' => $item->id]);
            return redirect('/item');
        }
        Log::error('商品の登録ができませんでした', ['data' => $request->all()]);
        return redirect('/item');
    }

    // 商品編集ページ
    // 商品編集ページの表示
    public function showEdit($id)
    {
        // itemsから1件取得
        $item = Item::find($id);
        // categoryから全件取得
        $categories = Category::all();
        // viewにアイテムとカテゴリを渡す
        return view("item.edit", [
            "item" => $item,
            "categories" => $categories
        ]);
    }

    // 商品編集の実行
    public function edit($id, EditItemRequest $request)
    {
        // 商品データを1件取得
        $item = Item::find($id);

        // リクエストからModelの$fillableに設定したプロパティのみを抽出・保存
        $item->fill($request->all())->save();

        // http://localhost/item_manager/public/itemにリダイレクト
        return redirect("/item");
    }
    
    // 商品削除の実行
    public function delete($id)
    {
        // id で削除したいデータを取得
        $item = Item::find($id);

        // 現在日時を取得、フォーマットを変換
        $date = date("Y-m-d H:i:s");

        // deleted_at に取得した日時を保存
        $item->deleted_at = $date;
        $item->save();

        // 一覧画面へリダイレクト
        return redirect("/item");
    }
    // 在庫の入出荷処理
    public function editStock(EditStockRequest $request, $id)
    {
        // URLのidを利用してItemモデルから1件取得
        $item = Item::find($id);

        // $requestから入力された在庫数を取得
        $stock = collect($request->input("stock"))->values()->first();
        // $requestから対象となる商品を特定するkeyを取得
        $key = collect($request->input("stock"))->keys()->first();

        // 入荷の場合
        if ($request->has("in")) {
            // 商品の在庫数に$stockを加算
            $item->stock += $stock;

            // 出荷の場合
        } else if ($request->has("out")) {
            // 在庫数が0の状態で出荷をする場合
            if ($item->stock == 0) {
                // バリデーションエラーのメッセージを投げる
                throw ValidationException::withMessages([
                    'stock.' . $key => '在庫がありません。'
                ]);
                // 出荷数が在庫数を上回っている場合
            } elseif ($item->stock < $stock) {
                // バリデーションエラーのメッセージを投げる
                throw ValidationException::withMessages([
                    'stock.' . $key => '出荷数は在庫数以下の入力をしてください。'
                ]);
            } else {
                // 商品の在庫数から$stockを減算
                $item->stock -= $stock;
            }
        }

        // 在庫数の変動を保存
        $item->save();

        // 一覧ページへのリダイレクト
        return redirect("/item");
    }
    
    //認証済みユーザの詳細情報
    public function detail()
    {
        return view('item.detail');
    }
}