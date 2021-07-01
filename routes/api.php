<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/product',[ ProductController::class,'index'] );
Route::get('/product/{id}',[ ProductController::class,'show'] );
Route::get('/product/search/{name}',[ ProductController::class,'search'] );
Route::post('/register',[ AuthController::class,'register']);
Route::post('/login',[ AuthController::class,'login']);
// Route::post('/product',[ ProductController::class,'store']);
//Route::resource('/product',ProductController::class );
Route::group(['middleware'=>['auth:sanctum']], function () {
    

Route::post('/product',[ ProductController::class,'store']);
Route::put('/product/{id}',[ ProductController::class,'update']);
Route::delete('/product/{id}',[ ProductController::class,'destroy']);
Route::post('/logout',[ AuthController::class,'logout']);
    
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

