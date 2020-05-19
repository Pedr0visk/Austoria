<?php

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    Route::get('/products', 'ProductController@index')->name('products.index');
    Route::post('/products', 'ProductController@store')->name('products.store');
    Route::get('/products/{product}', 'ProductController@edit')->name('products.edit');
    Route::patch('/products/{product}', 'ProductController@update')->name('products.update');
    Route::get('/products/search', 'ProductController@search')->name('products.search');
    Route::delete('/products/{product}', 'ProductController@destroy')->name('products.destroy');

    Route::get('/categories', 'CategoryController@index')->name('categories.index');
    Route::post('/categories', 'CategoryController@store')->name('categories.store');
    Route::delete('/categories/{category}', 'CategoryController@destroy')->name('categories.destroy');

    Route::get('/customers', 'CustomerController@index')->name('customers.index');
    Route::post('/customers', 'CustomerController@store')->name('customers.store');
    Route::get('/customers/{customer}', 'CustomerController@edit')->name('customers.edit');
    Route::patch('/customers/{customer}', 'CustomerController@update')->name('customers.update');
    Route::delete('/customers/{customer}', 'CustomerController@destroy')->name('customers.destroy');
    Route::get('/customer/history/{customer}', 'CustomerController@history')->name('customers.history');

    Route::get('/sales/search', 'SaleController@search')->name('sales.search');
    Route::get('/sales/create', 'SaleController@create')->name('sales.create');
    Route::get('/sales', 'SaleController@index')->name('sales.index');
    Route::get('/sales/{sale}', 'SaleController@show')->name('sales.show');
    Route::delete('/sales/{sale}', 'SaleController@destroy')->name('sales.destroy');

    Route::get('/metrics/sales', 'MetricsController@index');

    Route::get('/payments', 'PaymentController@index');
    Route::post('/payments', 'PaymentController@store');


    Route::get('/home', 'HomeController@index')->name('home');
});

Auth::routes();
