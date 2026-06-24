<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product; //商品
use App\Models\ProductImage; //商品画像
use App\Http\Resources\AdminProductResource; 
use App\Http\Requests\StoreProductRequest;
use Illuminate\Validation\ValidationException; // バリデーションエラーを捕捉するために追加


class AdminProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $products = Product::all();
        return AdminProductResource::collection($products);

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
            if ($request->hasFile('images')) {
            foreach($request->file('images') as $image){

            // 画像ファイルを storage/app/public/images に保存
            $image_name = $image->getClientOriginalName();
            $path = $image->store('images', 'public');    

            ProductImage::create([
                'product_id' => $product->id,
                'image_name' => $image_name,
                'path'    => $path,
            ]);
            // dd($request->all());
            }
            }

            return (new AdminProductResource($product))
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
            $product = Product::with('product_images')->findOrFail($id);
        // 単一データの場合は、ProductResource を適用
        return new AdminProductResource($product);


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreProductRequest $request, string $id)
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
