<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product; //商品
use App\Models\ProductImage; //商品画像
use App\Http\Resources\ProductResource; 
use App\Http\Requests\StoreProductRequest;
use Illuminate\Validation\ValidationException; // バリデーションエラーを捕捉するために追加
use Illuminate\Support\Facades\DB; 


class AdminProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $products = Product::all();
        return ProductResource::collection($products);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        //
        try{
            // productテーブルへ新規商品を登録
            $product = Product::create($request->validated());

            // product_imageテーブルへ商品画像を挿入

            foreach($request->file('images') as $image){

              // 画像ファイルを storage/app/public/images に保存
                $path = $image->store('images', 'public');    

            $product->product_images()->create($request->validated());
            }



            return (new ProductResource($product))
                ->additional(['message' => '商品情報が登録されました'])
                ->response()
                ->setStatusCode(201);
        }catch(ValidationException $e){
            return response()->json([
                'errors' => $e->errors()
            ], 422);
        }
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
