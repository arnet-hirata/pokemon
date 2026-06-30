<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
class CartItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $carts = CartItem::with('product')
        ->where('user_id', $request->user()->id)
        ->get();

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
        
        $product = Product::find($request->product_id);

        if($product->stock <=0){
            return response()->json([
                'message' => '在庫がありません'
            ], 400);
        }

        $carts = CartItem::where('user_id', $request->user()->id)
        ->where('product_id', $request->product_id)
        ->get();

        if($carts->count()> 0){
            $totalQuantity = $carts->sum('quantity') + $request->quantity;

            if($totalQuantity > $product->stock){
                return response()->json([
                    'message' => '在庫数を超えています'
            ], 400);
            }
            $firstCart = $carts->first();

            $firstCart->quantity = $totalQuantity;
            $firstCart->save();

            CartItem::where('user_id', $request->user()->id)
            ->where('product_id', $request->product_id)
            ->where('id', '!=', $firstCart->id)
            ->delete();

        }else{
            if($request->quantity > $product->stock){
                return response()->json([
                'message' => '在庫数を超えています'
            ], 400);
            }
CartItem::create([
            'user_id' => $request->user()->id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity
        ]);
        }

        return response()->json([
            'message' => 'カートに追加しました'
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
