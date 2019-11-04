<?php

Route::post('/products', 'ProductController@store');
Route::patch('/products/{product}', 'ProductController@update');
Route::delete('/products/{product}', 'ProductController@destroy');

Route::post('/categories', 'CategoryController@store');

Route::post('/customers', 'CustomerController@store');

Route::post('/sales', 'SaleController@store');