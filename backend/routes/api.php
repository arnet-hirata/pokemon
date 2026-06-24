<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AdminProductController;
use App\Http\Controllers\Api\ProductsController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// 管理者
Route::apiResource('admin/products', AdminProductController::class);

Route::get('products/search', [ProductsController::class, 'search']);