<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\homecontroller;
use App\Http\Controllers\usersController;
use App\Http\Controllers\courseController;
use App\Http\Controllers\contentController;
use App\Http\Controllers\myParticipantController;

Route::get('/', [homecontroller::class, 'index']);

Route::prefix('/admin')->group(function () {
    Route::get('/', [homecontroller::class, 'index']);
    Route::resource('/users', usersController::class);
    Route::resource('/course', courseController::class);
    Route::resource('/content', contentController::class);
    Route::resource('/myparticipant', myParticipantController::class);
});


Route::prefix('/author')->group(function () {
    Route::get('/', [homecontroller::class, 'index']);
    Route::resource('/users', usersController::class);
    Route::resource('/course', courseController::class);
    Route::resource('/content', contentController::class);
});

//BAGUSSS PUNYAAA DO NOT TOCHHH PLSS, THANKS b(^_^)d//


Route::get('/author', function () {
    return view('author.course.index');
});
Route::get('/authorcoursecreate', function () {
    return view('admin.course.create');
});
Route::get('/authorcourseshow', function () {
    return view('admin.course.show');
});

Route::get('/adminindex', function () {
    return view('admin.content.index');
});
Route::get('/deepseek', function () {
    return view('admin.course.deepseek');
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

Route::get('/usercourse', function () {
    return view('user.course.index');
});

Route::get('/usercontentcourse', function () {
    return view('user.course.content');
});

Route::get('/useroverviewcourse', function () {
    return view('user.course.overview');
});

Route::get('/usermycourse', function () {
    return view('user.mycourse.index');
});

Route::get('/userhistory', function () {
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
