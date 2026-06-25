<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product; //商品
use App\Http\Resources\AdminProductResource; 
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Validation\ValidationException; // バリデーションエラーを捕捉するために追加
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class AdminProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $products = Product::with('category')->get();
        return AdminProductResource::collection($products);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        //
                    // dd($request->all());

        try{

        // 片方失敗したらロールバック
        $product = DB::transaction(function() use ($request){
            // productテーブルへ新規商品を登録
            $product = Product::with('category')->create($request->validated());


            // product_imageテーブルへ商品画像を挿入
            if ($request->hasFile('product_images')) {
            foreach($request->file('product_images') as $image){

            // 画像ファイルを storage/app/public/images に保存
            $image_name = $image->getClientOriginalName();
            $path = $image->store('images', 'public');    

            $product->product_images()->create([
                'product_id' => $product->id,
                'image_name' => $image_name,
                'path'    => $path,
            ]);
            }
            }
            return $product;
        });

        $product->load('product_images');
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
            $product = Product::with(['product_images','category'])->findOrFail($id);
        // 単一データの場合は、ProductResource を適用

        return new AdminProductResource($product);


    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, string $id)
    {
        //
                    // dd($request->all());
            try {
            $product = Product::with('product_images')->findOrFail($id);
            DB::transaction(function() use ($request,$product){

            // productテーブル更新
            $product->update($request->validated());

            // ストレージ削除
            if($request->hasFile('product_image')){
            foreach($product->product_images as $image){
                Storage::disk('public')->delete($image->path);
            }
            }
            
            // DBレコード削除
            $product->product_images()->delete();

            // product_imageテーブルへ商品画像を挿入(アップデート)
            if ($request->hasFile('product_images')) {
            foreach($request->file('product_images') as $image){

            // 画像ファイルを storage/app/public/images に保存
            $image_name = $image->getClientOriginalName();
            $path = $image->store('images', 'public');    

            $product->product_images()->create([
                'product_id' => $product->id,
                'image_name' => $image_name,
                'path'    => $path,
            ]);
            }
            }
            // return $product;
        });
        $product->load('product_images');
            // 成功レスポンス
            return (new AdminProductResource($product))
                ->additional(['message' => '商品情報が更新されました'])
                ->response()
                ->setStatusCode(200);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'バリデーションエラー',
                'errors' => $e->errors()
            ], 422);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            $product = Product::with('product_images')->findOrFail($id);

            DB::transaction(function() use ($product){
                // public/パス削除
            foreach($product->product_images as $image){
                Storage::disk('public')->delete($image->path);
            }
            // product_imageレコード削除
            $product->product_images()->delete();

            // productレコード削除
            $product->delete();

            });

            return response()->json([
                'message' => '登録商品が削除されました',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => '削除に失敗しました',
            ], 404);
        }
    }
}
