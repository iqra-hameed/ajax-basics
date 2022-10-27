<?php
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProdController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\imageController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\NotificationController;
use App\Models\User;



Auth::routes();
   
Route::group(['middleware' => ['auth']], function() {
Route::get('/',[LoginController::class,'index']);
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::resource('roles', RoleController::class);
Route::resource('users', UserController::class);
Route::resource('categories',CategoryController::class)->except(['show']);
Route::resource('apis',ApiController::class);
Route::resource('products',ProdController::class)->except(['show']);
Route::resource('documents', DocumentController::class);
});