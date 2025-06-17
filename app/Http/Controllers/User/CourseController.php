<?php

namespace App\Http\Controllers\User;

use App\Models\Course;
use App\Models\Category;
use App\Models\Content;
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
        $query = Course::with(['category', 'user'])->withCount('enrollments')->where('status', 1);

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
    public function show(Course $course, Request $request) // <-- TAMBAHKAN Request $request
    {
        if (!$course->status) {
            return redirect()->route('user.course.index')->with('error', 'Kursus tidak ditemukan.');
        }

        $isEnrolled = false;
        if (Auth::check()) {
            $isEnrolled = Enrollment::where('user_id', Auth::id())
                ->where('course_id', $course->id)
                ->exists();
        }

        // Ambil parameter 'from' dari URL
        $from = $request->query('from');

        // Kirim semua variabel yang diperlukan ke view, termasuk 'from'
        return view('user.course.overview', compact('course', 'isEnrolled', 'from'));
    }

    /**
     * Menampilkan halaman detail sebuah konten dari sebuah course.
     */
    public function showContent(Course $course, Content $content, Request $request)
    {
        // Validasi apakah user sudah terdaftar di course ini (opsional)
        $isEnrolled = false;
        if (Auth::check()) {
            $isEnrolled = Enrollment::where('user_id', Auth::id())
                ->where('course_id', $course->id)
                ->exists();
        }

        // Jika ingin memvalidasi enrollment sebelum bisa akses content
        // if (!$isEnrolled) {
        //     return redirect()->route('user.course.show', $course->slug)
        //         ->with('error', 'Anda harus mendaftar terlebih dahulu untuk mengakses konten ini.');
        // }

        // Ambil parameter 'from' dari URL
        $from = $request->query('from');

        // Kirim semua data yang diperlukan ke view
        return view('user.course.content', compact('course', 'content', 'from', 'isEnrolled'));
    }
}
