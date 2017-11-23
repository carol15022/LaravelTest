<?php

Route::resource('/painel/products', 'ProductController');

Route::get('/', function () {
    return view('welcome');
});

Route::group(array('prefix'=>'api'), function()
{
    Route::post('/products', 'ApiController@store');
    Route::get('/products', 'ApiController@index');
    Route::put('/products/{id}', 'ApiController@update');
    Route::delete('/products/{id}', 'ApiController@destroy');
});

//CSV
Route::get('/import', 'ImportCsvController@import');
Route::post('/import', 'ImportCsvController@importCsv');