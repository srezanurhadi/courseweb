<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\enrollments as Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnrollmentController extends Controller
{
    /**
     * Menyimpan data pendaftaran user ke sebuah course.
     */
    public function store(Request $request, Course $course)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Cek apakah user sudah terdaftar di kursus ini sebelumnya
        $isEnrolled = Enrollment::where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->exists();

        if ($isEnrolled) {
            return back()->with('error', 'Anda sudah terdaftar di kursus ini.');
        }

        // Jika belum, buat record pendaftaran baru
        Enrollment::create([
            'user_id' => $user->id,
            'course_id' => $course->id,
        ]);

        // Redirect ke halaman overview kursus tersebut dengan pesan sukses
        return redirect()->route('user.course.show', $course->slug)->with('success', 'Selamat, Anda berhasil mendaftar kursus!');
    }
}
