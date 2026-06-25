<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function Order(){
        return $this->belongsToMany(Order::class,'order_details','product_id', 'order_id')->withPivot('quantity','product_price','created_at');
    }
}
