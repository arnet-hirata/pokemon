<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class CartItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carts = CartItem::with('product')
        ->where('user_id', auth()->id())
        ->get();
        
        logger('carts debug', ['carts' => $carts->toArray()]); logger('auth id', ['id' => auth()->id()]);

        return response()->json($carts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // var_dump($request);
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = CartItem::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'quantity' => $request->quantity
        ]);
        return response()->json([
            'message' => 'カートに追加しました',
            'cart' => $cart
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $cart = CartItem::where('id', $id)
        ->where('user_id', $request->user()->id)
        ->first();

        if(!$cart){
            return response()->json([
                'message' => '商品が見つかりません'
            ], 404);
        }

        $cart->delete();

        return response()->json([
            'message' => 'カートから削除'
        ]);
    }
}
