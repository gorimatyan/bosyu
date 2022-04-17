<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public function recruitments(){
        return $this->belongsToMany(Recruitment::class)
                    ->withTimestamps();
    }

    public function users(){
        return $this->belongsToMany(User::class,'favorite_tags','tag_id','user_id')
                    ->withPivot('created_at');
                    // ↑withPivotは外部キー以外の中間テーブルの値を取得する。なお、外部キーの値はデフォルトで取得する。
    }
}
