<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProdController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Resources\ProductResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\RegisterInfoResource;
use App\Models\Prod;
use App\Models\User;
use App\Models\Category;

Route::post('register', [AuthController::class,'register']);

Route::post('login', [AuthController::class,'login']);
 Route::middleware('auth:sanctum')->group( function () {
});


   Route::get('categories', [CategoryController::class,'index']);
   Route::get('products', [ProdController::class,'index']);

   Route::get('search/{name}', [ProdController::class,'search']);
