<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;

/*
| AUTH
*/
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

/*
| PROTECTED ROUTES
*/
Route::middleware('auth:sanctum')->group(function () {

    // categories
    Route::apiResource('categories', CategoryController::class)
        ->except(['destroy']);

    Route::delete('categories/{category}', [CategoryController::class, 'destroy'])
        ->middleware('admin.role:admin');

    // items
    Route::apiResource('items', ItemController::class)
        ->except(['destroy']);

    Route::delete('items/{item}', [ItemController::class, 'destroy'])
        ->middleware('admin.role:admin');
});