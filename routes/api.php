<?php

use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('product/store' , [ProductController::class , 'store']);*/

Route::post('article/store',[\App\Http\Requests\storeArticlerequest::class,'storeArticle']);
Route::middleware('auth:sanctum')->group( function () {

    Route::resource('products', ProductController::class);

});