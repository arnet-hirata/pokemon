<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product; //商品
use App\Models\Stock; //商品
use App\Http\Resources\AdminProductResource;
use Illuminate\Support\Facades\DB;

class AdminStockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $id)
    {
        //
        $request->validate([
            'change_stock' => 'required|integer|min:1',
            'reason' => 'required|string',
        ]);

        $product = Product::findOrFail($id);

        DB::transaction(function () use ($request, $product) {
            if ($request->reason === '入庫') {
                $product->stock += $request->change_stock;
            } elseif ($request->reason === '出庫') {
                $product->stock -= $request->change_stock;
            }
            $product->save();

            Stock::create([
                'product_id' => $product->id,
                'change_stock' => $request->change_stock,
                'reason' => $request->reason,
            ]);
        });
        return response()->json([
            'message' => '在庫を更新しました'
        ], 200);
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
    public function destroy(string $id)
    {
        //
    }
}
