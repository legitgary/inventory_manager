<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api\v1'], function() {
    Route::apiResource('stores', StoreController::class);
    Route::apiResource('items', ItemController::class);

    Route::post('/items/{item}/add', 'ItemController@stockIncrease')->name('item.stock.add');
    Route::post('/items/{item}/remove', 'ItemController@stockDecrease')->name('item.stock.remove');
});