<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\CartItem;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
class OrderController extends Controller
{

public function index(Request $request)
    {
        $user = $request->user();

        $carts = CartItem::with('product')
        ->where('user_id', $user->id)
        ->get();
    
        $totalPrice = $carts->sum(function($cart) {
            return $cart->product->price * $cart->quantity;
        });

        return response()->json([
            'user' => $user,
            'carts' => $carts,
            'total_price' => $totalPrice
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'pay_method' => 'required'
        ]);

        $user = $request->user();

        $carts = CartItem::with('product')
        ->where('user_id', $user->id)
        ->get();

        Log::debug('checkout store debug', [
    'request_all' => $request->all(),
    'user_id' => $request->user()?->id,
    'carts_count' => $carts->count(),
    'carts' => $carts->toArray(),
]);
        if($carts->isEmpty()){
            return response()->json([
                'message' => 'カートが空です'
            ], 400);
        }

        DB::beginTransaction();

        try{

        $totalPrice = 0;

            foreach($carts as $cart){
            if($cart->product->stock < $cart->quantity){
                throw new \Exception(
                    $cart->product->name . ' の在庫が不足しています'
                );
            }
            $totalPrice +=
            $cart->product->price * $cart->quantity;
        }

        $order = Order::create([
            'user_id' => $user->id,
            'pay_method' => $request->pay_method,
            'total_price' => $totalPrice,
            'address' => $user->address,
            'order_status' => true
        ]);

        foreach($carts as $cart){
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $cart->product_id,
                'quantity' => $cart->quantity,
                'product_price' => $cart->product->price
            ]);

            $cart->product->decrement(
                'stock',
                $cart->quantity
            );
        }

        CartItem::where('user_id', $user->id)->delete();

        DB::commit();

        return response()->json([
            'message' => '購入完了'
        ]);
    } catch (\Exception $e){
        DB::rollBack();

        return response()->json([
            'message' => $e->getMessage()
        ],400);
    }
    }


}