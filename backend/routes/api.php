<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AdminProductController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MypageController;
use App\Http\Controllers\Api\ProductsController;
use App\Http\Controllers\Api\CartItemController;
use App\Http\Controllers\Api\OrderDetailController;
use App\Http\Controllers\Api\OrderController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// 管理者
// Route::apiResource('admin/products', AdminProductController::class);
Route::get('/products/search', [ProductsController::class, 'search']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login',    [AuthController::class, 'login'])->name('api.login');
Route::apiResource('/products', ProductsController::class);
// auth:sanctum で囲むとトークン必須（ログイン必要）
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('admin/products', AdminProductController::class);
    Route::get('/user', fn(Request $request) => $request->user());
    Route::put('/user/edit/{id}', [AuthController::class, 'update']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/mypage', [MypageController::class, 'index']);
    Route::post('/cart', [CartItemController::class, 'store']);
    Route::get('/cart', [CartItemController::class, 'index']);
    Route::get('/order/detail/{id}', [OrderDetailController::class, 'index']);
    Route::get('/order', [OrderController::class, 'index']);
    Route::post('/order', [OrderController::class, 'store']);
    Route::delete('/cart/{id}', [CartItemController::class, 'destroy']);
});
