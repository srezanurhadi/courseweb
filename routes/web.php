<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\homecontroller;
use App\Http\Controllers\usersController;
use App\Http\Controllers\courseController;
use App\Http\Controllers\contentController;


Route::get('/', [homecontroller::class, 'index']);

Route::prefix('/admin')->group(function () {
    Route::get('/', [homecontroller::class, 'index']);
    Route::resource('/users', usersController::class);
    Route::resource('/course', courseController::class);
    Route::resource('/content', contentController::class);
    Route::get('/anggota', function () {
        return view('admin.myParticipant.index');
    });
    Route::get('/anggotalihat', function () {
        return view('admin.myParticipant.show');
    });
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
Route::prefix('/user')->name('user.')->group(function () {
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

    Route::get('/profile', function () {
        return view('user.myprofile.index');
    })->name('profile');

    Route::get('/profile/edit', function () {
        return view('user.myprofile.edit');
    })->name('profile.edit');

    Route::get('/profile/course/{id}', function ($id) {
        return view('user.myprofile.detail', ['courseId' => $id]);
    })->name('course.detail');
});

// AUDENA PUNYA

Route::get('/login', function () {
    return view('user.index');
});

Route::get('/register', function () {
    return view('user.register');
});
