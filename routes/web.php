<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\homecontroller;
use App\Http\Middleware\adminMiddleware;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\usersController;
use App\Http\Middleware\authorMiddleware;
use App\Http\Controllers\courseController;
use App\Http\Controllers\contentController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Middleware\participantMiddleware;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\myParticipantController;
use App\Http\Controllers\User\MyCourseController;
use App\Http\Controllers\User\EnrollmentController;
use App\Http\Controllers\User\CourseController as UserCourseController;

Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');

Route::prefix('/admin')->middleware(adminMiddleware::class)->group(function () {

    // Route khusus untuk AJAX search
    Route::get('/course/search', [courseController::class, 'search'])->name('course.search');

    Route::get('/', [homecontroller::class, 'index']);
    // route khusus image di editor
    Route::post('/upload-image', [ImageController::class, 'store'])->name('image.store');
    Route::post('/admin/delete-image', [ImageController::class, 'destroy'])->name('admin.image.destroy');
    
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

    Route::get('/course', [UserCourseController::class, 'index'])->name('course.index');

    Route::get('/course/{course:slug}/content/{content}', [UserCourseController::class, 'showContent'])->name('user.course.content.show');

    // Updated route for content with pagination support
    Route::get('/course/{course:slug}/content/{content}', [UserCourseController::class, 'showContent'])->name('course.content.show');

    Route::get('/course/{course:slug}/content/{content}', [UserCourseController::class, 'showContent'])->name('course.content.show');
    Route::get('/course/{course:slug}', [UserCourseController::class, 'show'])->name('course.show');
    Route::post('/enroll/{course:slug}', [EnrollmentController::class, 'store'])->name('course.enroll');
    Route::delete('/unenroll/{course:slug}', [EnrollmentController::class, 'destroy'])->name('course.unenroll');

    Route::get('/mycourse', [MyCourseController::class, 'myCourses'])->name('mycourse.index');
    Route::get('/history', [MyCourseController::class, 'history'])->name('history');

    // Rute Profil yang sudah benar
    Route::get('/profile', [myParticipantController::class, 'showProfile'])->name('profile');
    Route::get('/profile/edit', [myParticipantController::class, 'editProfile'])->name('profile.edit');
    Route::post('/profile/update', [myParticipantController::class, 'updateProfile'])->name('profile.update'); // Nama sudah benar

    Route::get('/profile/course/{id}', [myParticipantController::class, 'showCourseDetail'])->name('course.detail');
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
