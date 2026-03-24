<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// categoriesを単数形、アッパーキャメルケースで記述
class Category extends Model
{
    // created_at, updated_atの自動挿入を無効化
    public $timestamps = false;

    // INSERT,UPDATEで許可するカラムを指定
    protected $fillable = [
        "name"
    ];
    // itemsテーブルとのリレーション設定
    public function items(): HasMany
    {
        // カテゴリから見た場合は一対多になる
        return $this->hasMany(Item::class);
    }
}