<?php

Route::get('/dashboard', 'DashboardController@index');

Route::get('/products', 'ProductController@index')->name('products.index');
Route::post('/products', 'ProductController@store')->name('products.store');
Route::get('/products/{product}', 'ProductController@edit')->name('products.edit');
Route::patch('/products/{product}', 'ProductController@update')->name('products.update');
Route::delete('/products/{product}', 'ProductController@destroy')->name('products.destroy');

Route::post('/categories', 'CategoryController@store');

Route::get('/customers', 'CustomerController@index')->name('customers.index');
Route::post('/customers', 'CustomerController@store')->name('customers.store');
Route::patch('/customers/{customer}', 'CustomerController@update');

Route::get('/sales/create', 'SaleController@create')->name('sales.create');
Route::get('/sales', 'SaleController@index');
