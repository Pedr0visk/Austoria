<?php

Route::post('/items', 'ItemController@store');
Route::patch('/items/{item}', 'ItemController@update');
Route::delete('/items/{item}', 'ItemController@destroy');

Route::post('/categories', 'CategoryController@store');