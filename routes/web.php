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
Route::get('/admincreate', function () {
    return view('admin.course.create');
});
//admin
Route::get('/coba', function () {
    return view('author.content.index');
});

Route::get('/home', function () {
    return view('user.home');
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

Route::get('/profile/edit', function () {
    return view('user.myprofile.edit');
})->name('profile.edit');

Route::get('/profile/course/{id}', function ($id) {
    return view('user.myprofile.detail', ['courseId' => $id]);
})->name('course.detail');