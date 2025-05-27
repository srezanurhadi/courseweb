<?php

use App\Http\Controllers\homecontroller;
use Illuminate\Support\Facades\Route;


Route::get('/', [homecontroller::class, 'index']);

Route::get('/hello', function () {
    return 'Hello Guys';
});

Route::get('/sidebar', function () {
    return view('components.sidebar');
});

Route::get('/home', function () {
    return view('user.index');
});

Route::get('/login', function() {
    return view('index');
});