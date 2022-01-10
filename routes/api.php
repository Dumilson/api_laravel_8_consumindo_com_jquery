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
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'prefix'=>'products'
], function(){
    Route::get('/',[ProductController::class, 'index'])->name('products');
    Route::get('/get-data/{id}',[ProductController::class, 'edit'])->name('products.edit');
    Route::post('/',[ProductController::class, 'store'])->name('products.store');
    Route::put('/',[ProductController::class, 'update'])->name('products.update');
    Route::delete('/',[ProductController::class, 'destroy'])->name('products.destroy');
});