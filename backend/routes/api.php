<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AdminProductController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductsController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// 管理者
Route::apiResource('admin/products', AdminProductController::class);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login',    [AuthController::class, 'login'])->name('api.login');

// auth:sanctum で囲むとトークン必須（ログイン必要）
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', fn (Request $request) => $request->user());
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::apiResource('/products', ProductsController::class);
});
