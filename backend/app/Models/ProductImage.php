<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    public function products(){
        // playersテーブルに設定したteam_idで関連付けする
        // $this->hasMany(<連携先クラス名>::class)
        return $this->hasMany(Product::class);
    }
}
