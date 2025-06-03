<?php

use App\Http\Controllers\homecontroller;
use Illuminate\Support\Facades\Route;


Route::get('/', [homecontroller::class, 'index']);

Route::get('/admin', function () {
    return 'Hello Guys';
});

//admin
Route::get('/admin', function () {
    return view('admin.course.index');
});
Route::get('/admincoursecreate', function () {
    return view('admin.course.create');
});
Route::get('/admincourseshow', function () {
    return view('admin.course.show');
});

//admin
Route::get('/coba', function () {
    return view('author.content.index');
});

Route::get('/home', function () {
    return view('user.home');
});

Route::get('/course', function () {
    return view('user.course.index');
});

Route::get('/login', function () {
    return view('user.index');
});

Route::get('/register', function () {
    return view('user.register');
});

Route::get('/profile', function () {
    return view('user.myprofile.index');
});
