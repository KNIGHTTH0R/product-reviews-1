<?php

use Illuminate\Http\Request;

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

/* Product routes */
Route::get( 'products', 'ProductsController@index' );
Route::get( 'products/{product}', 'ProductsController@show' );
Route::post( 'products', 'ProductsController@store' );
Route::put( 'products/{product}', 'ProductsController@update' );
Route::delete( 'products/{product}', 'ProductsController@destroy' );

/* Sellers routes */
/*Route::get( 'sellers', 'SellersController@index' );
Route::get( 'sellers/{id}', 'SellersProduct@show' );
Route::post( 'sellers/{id}', 'SellersProduct@store' );
Route::put( 'sellers/{id}', 'SellersProduct@update' );
Route::delete( 'sellers/{id}', 'SellersProduct@destroy' );*/
