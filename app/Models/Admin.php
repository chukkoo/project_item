<?php

namespace App\Models;
// Modelクラスの宣言
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

// itemsを単数形、アッパーキャメルケースで記述
// Modelクラスを継承
class Admin extends Model
{
    // created_atとupdated_atの自動挿入を無効化
    public $timestamps = false;

    // INSERT、UPDATEで許可するカラムを指定
    protected $fillable = [
        "name",
        "department_id"
    ];
    public function department(): BelongsTo
    {
        // 商品から見た場合は多対一になる
        return $this->belongsTo(Department::class);
    }
}