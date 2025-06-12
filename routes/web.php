<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\homecontroller;
use App\Http\Controllers\usersController;
use App\Http\Controllers\courseController;
use App\Http\Controllers\contentController;
use App\Http\Controllers\myParticipantController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Middleware\adminMiddleware;
use App\Http\Middleware\authorMiddleware;
use App\Http\Middleware\participantMiddleware;

Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');

Route::prefix('/admin')->middleware(adminMiddleware::class)->group(function () {
    Route::get('/', [homecontroller::class, 'index']);
    Route::resource('/users', usersController::class);
    Route::resource('/course', courseController::class);
    Route::resource('/content', contentController::class);
    Route::resource('/myparticipant', myParticipantController::class);
});


Route::prefix('/author')->middleware(authorMiddleware::class)->group(function () {
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
Route::prefix('/user')->middleware(participantMiddleware::class)->name('user.')->group(function () {
    Route::get('/home', function () {
        return view('user.home');
    })->name('home');

    Route::get('/course', function () {
        return view('user.course.index');
    })->name('course.index');

    Route::get('/course/content', function () {
        return view('user.course.content');
    })->name('course.content');

    Route::get('/course/overview', function () {
        return view('user.course.overview');
    })->name('course.overview');

    Route::get('/mycourse', function () {
        return view('user.mycourse.index');
    })->name('mycourse.index');

    Route::get('/history', function () {
        return view('user.history');
    })->name('history');

    // Rute Profil yang sudah benar
    Route::get('/profile', [myParticipantController::class, 'showProfile'])->name('profile');
    Route::get('/profile/edit', [myParticipantController::class, 'editProfile'])->name('profile.edit');
    Route::post('/profile/update', [myParticipantController::class, 'updateProfile'])->name('profile.update'); // Nama sudah benar

    Route::get('/profile/course/{id}', function ($id) {
        return view('user.myprofile.detail', ['courseId' => $id]);
    })->name('course.detail');
});

// AUDENA PUNYA

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
// Proses data dari form login
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
// Proses data dari form register
Route::post('/register', [RegisterController::class, 'register']);

// Route untuk halaman syarat dan ketentuan
Route::get('/terms', function () {
    return view('user.terms');
})->name('terms');