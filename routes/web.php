<?php

use App\Http\Controllers\homecontroller;
use Illuminate\Support\Facades\Route;


Route::get('/', [homecontroller::class, 'index']);

Route::get('/admin', function () {
    return 'Hello Guys';
});

Route::get('/admin', function () {
    return view('admin.course.index');
});
Route::get('/coba', function () {
    return view('author.content.show');
}); 

Route::get('/home', function () {
    return view('user.index');
});
