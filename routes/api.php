<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;

Route::apiResource('products', ProductController::class);
Route::apiResource('categories', CategoryController::class);
Route::get('active-categories', [CategoryController::class, 'getActiveCategories']);

