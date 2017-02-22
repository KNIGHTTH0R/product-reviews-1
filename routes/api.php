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
Route::get( 'sellers', 'SellersController@index' );
Route::get( 'sellers/{seller}', 'SellersController@show' );
Route::post( 'sellers/', 'SellersController@store' );
Route::put( 'sellers/{seller}', 'SellersController@update' );
Route::patch( 'sellers/{seller}', 'SellersController@partialUpdate' );
Route::delete( 'sellers/{seller}', 'SellersController@destroy' );

Route::post( 'sellers/{seller}/address', 'SellersController@setAddress' );
Route::put( 'sellers/{seller}/address', 'SellersController@updateAddress' );