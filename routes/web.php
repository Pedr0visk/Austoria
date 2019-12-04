<?php

Route::get('/products', 'ProductController@index')->name('products.index');
Route::post('/products', 'ProductController@store')->name('products.store');
Route::get('/products/{product}', 'ProductController@edit')->name('products.edit');
Route::patch('/products/{product}', 'ProductController@update')->name('products.update');
Route::delete('/products/{product}', 'ProductController@destroy')->name('products.destroy');

Route::post('/categories', 'CategoryController@store');

Route::get('/customers', 'CustomerController@index');
Route::post('/customers', 'CustomerController@store');
Route::patch('/customers/{customer}', 'CustomerController@update');

Route::post('/sales', 'SaleController@store');