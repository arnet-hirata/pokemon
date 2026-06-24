<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    public function products(){
        return $this->belongsTo(Product::class);
    }
    public function orders(){
        return $this->belongsTo(Order::class);
    }
}
