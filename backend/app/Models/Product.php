<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'price',
        'category_id',
        'release_date',
        'text',
        'stock',
    ];

    public function cart_items(){
        return $this->hasMany(CartItem::class);
    }
    public function product_images(){
        return $this->hasMany(ProductImage::class);
    }
    public function order_details(){
        return $this->hasMany(OrderDetail::class);
    }
    public function categories(){
        // playersテーブルに設定したteam_idで関連付けする
        // $this->hasMany(<連携先クラス名>::class)
        return $this->belongsTo(Category::class);
    }
}
