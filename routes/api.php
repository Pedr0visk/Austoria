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

Route::get('products/search', 'ProductController@search');
Route::get('products', 'ProductController@index');

Route::post('/sales', 'SaleController@store');

Route::get('customers/search', 'CustomerController@search');
Route::post('customers', 'CustomerController@store');

