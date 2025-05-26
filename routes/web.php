<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello', function () {
    return 'Hello Guys';
});

Route::get('/sidebar', function () {
    return view('components.sidebar');
});
