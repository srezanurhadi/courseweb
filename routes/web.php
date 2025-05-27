<?php

use App\Http\Controllers\homecontroller;
use Illuminate\Support\Facades\Route;


Route::get('/',[homecontroller::class, 'index']);

Route::get('/admin', function () {
    return 'Hello Guys';
});

Route::get('/admin', function () {
    return view('author.content.index');
});

Route::get('/test', function () {
    return 'test';
});
