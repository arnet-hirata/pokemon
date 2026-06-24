<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function cart_items(){
        return $this->hasMany(CartItem::class);
    }
}
