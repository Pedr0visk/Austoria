<?php

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Route::get('/products', 'ProductController@index')->name('products.index');
Route::get('/products/search', 'ProductController@search')->name('products.search');
Route::post('/products', 'ProductController@store')->name('products.store');
Route::delete('/products/{product}', 'ProductController@destroy')->name('products.destroy');

Route::get('/categories', 'CategoryController@index')->name('categories.index');
Route::post('/categories', 'CategoryController@store')->name('categories.store');
Route::delete('/categories/{category}', 'CategoryController@destroy')->name('categories.destroy');

Route::get('/customers', 'CustomerController@index')->name('customers.index');
Route::post('/customers', 'CustomerController@store')->name('customers.store');
Route::patch('/customers/{customer}', 'CustomerController@update')->name('customers.update');
Route::delete('/customers/{customer}', 'CustomerController@destroy')->name('customers.destroy');

Route::get('/sales/search', 'SaleController@search')->name('sales.search');
Route::get('/sales/create', 'SaleController@create')->name('sales.create');
Route::get('/sales', 'SaleController@index')->name('sales.index');
Route::get('/sales/{sale}', 'SaleController@show')->name('sales.show');

Route::namespace('SalesReport')->group(function () {
    Route::get('/reports/sales', 'ReportController@index')->name('reports.index');
    Route::get('/reports/sales/{date}', 'ReportController@show')->name('reports.sales');
});
