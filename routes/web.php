<?php

use App\Http\Controllers\homecontroller;
use App\Http\Controllers\usersController;
use Illuminate\Support\Facades\Route;


Route::get('/', [homecontroller::class, 'index']);
Route::resource('/users',usersController::class);
Route::get('/admin', function () {
    return 'Hello Guys';
});

//admin
Route::get('/admin', function () {
    return view('admin.course.index');
});
Route::get('/admincreate', function () {
    return view('admin.course.create');
});
//admin
Route::get('/coba', function () {
    return view('admin.users.index');
});

Route::get('/home', function () {
    return view('user.home');
});

Route::get('/login', function () {
    return view('user.index');
});
