<?php

use App\Http\Controllers\homecontroller;
use App\Http\Controllers\usersController;
use Illuminate\Support\Facades\Route;


Route::get('/', [homecontroller::class, 'index']);
Route::resource('/users', usersController::class);
Route::get('/admin', function () {
    return 'Hello Guys';
});

//BAGUSSS PUNYAAA DO NOT TOCHHH PLSS, THANKS b(^_^)d//
Route::get('/admin', function () {
    return view('admin.course.index');
});
Route::get('/admincoursecreate', function () {
    return view('admin.course.create');
});
Route::get('/admincourseshow', function () {
    return view('admin.course.show');
});

Route::get('/author', function () {
    return view('author.course.index');
});
Route::get('/authorcoursecreate', function () {
    return view('admin.course.create');
});
Route::get('/authorcourseshow', function () {
    return view('admin.course.show');
});

//BAGUSSS PUNYAAA DO NOT TOCHHH PLSS, THANKS b(^_^)d//

//admin
Route::get('/coba', function () {
    return view('admin.users.index');
});

// AUDENA PUNYA
Route::get('/home', function () {
    return view('user.home');
});

Route::get('/course', function () {
    return view('user.course.index');
});

Route::get('/content', function () {
    return view('user.course.content');
});

Route::get('/overview', function () {
    return view('user.course.overview');
});

Route::get('/mycourse', function () {
    return view('user.mycourse.index');
});

Route::get('/history', function () {
    return view('user.history');
});
// AUDENA PUNYA

Route::get('/login', function () {
    return view('user.index');
});

Route::get('/register', function () {
    return view('user.register');
});

Route::get('/profile', function () {
    return view('user.myprofile.index');
});
