<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function order_details(){
        return $this->hasMany(OrderDetail::class);
    }
    public function Product(){
        return $this->belongsToMany(Product::class,'order_details','order_id', 'product_id')->withPivot('pay_method','total_price','order_status');
    }
    
}
