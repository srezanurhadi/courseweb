<?php

namespace App\Http\Controllers\User;

use App\Models\Course;
use App\Models\Category;
use App\Models\enrollments as Enrollment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    /**
     * Menampilkan daftar semua course.
     */
    public function index(Request $request)
    {
        $categories = Category::all();
        $query = Course::with(['category', 'user'])->where('status', 1);

        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            // Cari di judul ATAU deskripsi
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', '%' . $searchTerm . '%')
                    ->orWhere('description', 'like', '%' . $searchTerm . '%');
            });
        }

        $courses = $query->latest()->paginate(8);
        return view('user.course.index', [
            'courses' => $courses,
            'categories' => $categories
        ]);
    }

    /**
     * Menampilkan halaman detail sebuah course.
     * Menggunakan Route Model Binding dengan 'slug'.
     */
    public function show(Course $course)
    {
        // Pastikan kursus yang diakses sudah di-publish (status = 1)
        if (!$course->status) {
            // Jika belum, kembalikan ke halaman daftar kursus dengan pesan error
            return redirect()->route('user.course.index')->with('error', 'Kursus tidak ditemukan.');
        }

        // Cek apakah user yang sedang login sudah terdaftar di kursus ini
        $isEnrolled = false;
        if (Auth::check()) {
            $isEnrolled = Enrollment::where('user_id', Auth::id())
                ->where('course_id', $course->id)
                ->exists();
        }

        // Kirim variabel $isEnrolled ke view
        return view('user.course.overview', compact('course', 'isEnrolled'));
    }
}
