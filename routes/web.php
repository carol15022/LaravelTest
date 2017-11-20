<?php

Route::resource('/painel/products', 'ProductController');

Route::get('/', function () {
    return view('welcome');
});

