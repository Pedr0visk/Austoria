<?php

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Route::get('/products', 'ProductController@index')->name('products.index');
Route::get('/products/search', 'ProductController@search')->name('products.search');
Route::post('/products', 'ProductController@store')->name('products.store');
Route::delete('/products/{product}', 'ProductController@destroy')->name('products.destroy');

Route::get('/categories', 'CategoryController@index')->name('categories.index');
Route::post('/categories', 'CategoryController@store')->name('categories.store');

Route::get('/customers', 'CustomerController@index')->name('customers.index');
Route::post('/customers', 'CustomerController@store')->name('customers.store');
Route::patch('/customers/{customer}', 'CustomerController@update');

Route::get('/sales/search', 'SaleController@search')->name('sales.search');
Route::get('/sales/create', 'SaleController@create')->name('sales.create');
Route::get('/sales', 'SaleController@index')->name('sales.index');
Route::get('/sales/{sale}', 'SaleController@show')->name('sales.show');
