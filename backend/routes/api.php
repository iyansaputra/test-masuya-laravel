<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\TransactionController;

// test route dulu
Route::get('/ping', function () {
    return response()->json(['message' => 'pong']);
});

// resource route
Route::apiResource('products', ProductController::class);
Route::apiResource('customers', CustomerController::class);
Route::apiResource('transactions', TransactionController::class);
