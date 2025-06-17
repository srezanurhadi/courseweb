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
     * Updated untuk mendukung pagination
     */
    public function showContent(Course $course, $contentId, Request $request)
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

        // Get all course contents ordered by their order or id
        $allContents = $course->contents()->orderBy('id')->get();
        
        // If no dynamic contents exist, create static content structure
        if ($allContents->isEmpty()) {
            // Create static content data for pagination
            $staticContents = collect([
                (object)['id' => 1, 'title' => 'Content 1'],
                (object)['id' => 2, 'title' => 'Content 2'],
                (object)['id' => 3, 'title' => 'Content 3'],
                (object)['id' => 4, 'title' => 'Content 4'],
                (object)['id' => 5, 'title' => 'Content 5'],
                (object)['id' => 6, 'title' => 'Content 6'],
                (object)['id' => 7, 'title' => 'Content 7'],
                (object)['id' => 8, 'title' => 'Content 8'],
                (object)['id' => 9, 'title' => 'Content 9'],
                (object)['id' => 10, 'title' => 'Content 10'],
            ]);
            
            $currentContent = $staticContents->firstWhere('id', $contentId);
            if (!$currentContent) {
                abort(404, 'Content not found');
            }
            
            $allContents = $staticContents;
        } else {
            // Find current content from database
            $currentContent = $allContents->firstWhere('id', $contentId);
            if (!$currentContent) {
                abort(404, 'Content not found');
            }
        }

        // Find current content index
        $currentIndex = $allContents->search(function ($item) use ($contentId) {
            return $item->id == $contentId;
        });

        // Calculate pagination info
        $totalContents = $allContents->count();
        $currentPage = $currentIndex + 1;
        
        // Find previous and next content
        $previousContent = $currentIndex > 0 ? $allContents[$currentIndex - 1] : null;
        $nextContent = $currentIndex < $totalContents - 1 ? $allContents[$currentIndex + 1] : null;

        // Create pagination data
        $pagination = [
            'current_page' => $currentPage,
            'total_pages' => $totalContents,
            'has_previous' => $previousContent !== null,
            'has_next' => $nextContent !== null,
            'previous_content_id' => $previousContent ? $previousContent->id : null,
            'next_content_id' => $nextContent ? $nextContent->id : null,
            'all_contents' => $allContents
        ];

        // Ambil parameter 'from' dari URL
        $from = $request->query('from');

        // Kirim semua data yang diperlukan ke view
        return view('user.course.content', compact('course', 'currentContent', 'from', 'isEnrolled', 'pagination'));
    }
}
