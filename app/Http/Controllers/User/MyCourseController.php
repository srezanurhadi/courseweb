<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Content;
use App\Models\enrollments as Enrollment;
use App\Models\UserCourseProgress;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;


class MyCourseController extends Controller
{
    /**
     * Menampilkan daftar kursus yang diikuti oleh participant.
     */
    public function myCourses(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $lastSeenCourse = null;
        $categories = Category::all();

        // --- FUNGSI PERHITUNGAN PROGRES YANG KONSISTEN ---
        $calculateProgress = function ($course, $userId) {
            $totalContents = $course->contents_count;
            if ($totalContents === 0) {
                return 0;
            }
            // Hitung konten yang selesai dari tabel user_course_progress
            $completedContentsCount = UserCourseProgress::where('user_id', $userId)
                ->where('course_id', $course->id)
                ->count();
            return round(($completedContentsCount / $totalContents) * 100);
        };

        $isFilteringOrSearching = ($request->has('search') && $request->filled('search')) ||
            ($request->has('category') && $request->filled('category'));

        if (!$isFilteringOrSearching && $user->enrolledCourses()->exists()) {
            $lastEnrollment = Enrollment::where('user_id', $user->id)
                ->orderBy('updated_at', 'desc')
                ->first();

            if ($lastEnrollment) {
                $lastSeenCourse = Course::with(['category', 'user'])->withCount(['enrollments', 'contents'])->find($lastEnrollment->course_id);

                if ($lastSeenCourse) {
                    // === GUNAKAN LOGIKA PROGRES YANG BARU ===
                    $lastSeenCourse->progress_percentage = $calculateProgress($lastSeenCourse, $user->id);

                    if ($lastEnrollment->last_content_id) {
                        $lastSeenContent = Content::find($lastEnrollment->last_content_id);
                        if ($lastSeenContent) {
                            $lastSeenCourse->last_seen_content_title = $lastSeenContent->title;
                            $lastSeenCourse->last_seen_content_id = $lastSeenContent->id;
                        }
                    } else {
                        $lastSeenCourse->last_seen_content_title = 'Overview';
                        $lastSeenCourse->last_seen_content_id = null;
                    }
                }
            }
        }

        $enrolledCoursesQuery = $user->enrolledCourses()->withCount(['enrollments', 'contents'])->with(['category', 'user']);

        if ($lastSeenCourse && !$isFilteringOrSearching) {
            $enrolledCoursesQuery->where('courses.id', '!=', $lastSeenCourse->id);
        }

        if ($request->has('category') && $request->filled('category')) {
            $enrolledCoursesQuery->where('category_id', $request->category);
        }

        if ($request->has('search') && $request->filled('search')) {
            $searchTerm = $request->search;
            $enrolledCoursesQuery->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', '%' . $searchTerm . '%')
                    ->orWhere('description', 'like', '%' . $searchTerm . '%');
            });
        }

        $courses = $enrolledCoursesQuery->latest('enrollments.created_at')->paginate(8);

        foreach ($courses as $courseItem) {
            $courseItem->progress_percentage = $calculateProgress($courseItem, $user->id);
        }

        return view('user.mycourse.index', compact(
            'courses',
            'lastSeenCourse',
            'categories',
            'isFilteringOrSearching'
        ));
    }


    /**
     * Menampilkan halaman riwayat kursus yang telah selesai.
     */
    public function history(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $categories = Category::all();

        // Query untuk mengambil semua kursus yang diikuti user
        $enrolledCoursesQuery = $user->enrolledCourses()
            ->withCount(['enrollments', 'contents']) // Hitung total konten dan partisipan
            ->with(['category', 'user']);

        // Terapkan filter dari request (search & category)
        if ($request->has('search') && $request->filled('search')) {
            $searchTerm = $request->search;
            $enrolledCoursesQuery->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', '%' . $searchTerm . '%')
                    ->orWhere('description', 'like', '%' . $searchTerm . '%');
            });
        }

        if ($request->has('category') && $request->filled('category')) {
            $enrolledCoursesQuery->where('category_id', $request->category);
        }

        // 1. Ambil SEMUA kursus yang cocok filter (tanpa pagination dulu)
        $allEnrolledCourses = $enrolledCoursesQuery->latest('enrollments.created_at')->get();

        // Fungsi untuk menghitung progres yang akurat
        $calculateProgress = function ($course, $userId) {
            $totalContents = $course->contents_count;
            if ($totalContents === 0) {
                return 0;
            }
            $completedContentsCount = \App\Models\UserCourseProgress::where('user_id', $userId)
                ->where('course_id', $course->id)
                ->count();
            return round(($completedContentsCount / $totalContents) * 100);
        };

        // 2. Filter di PHP untuk mendapatkan HANYA kursus yang selesai
        $completedCoursesCollection = $allEnrolledCourses->filter(function ($course) use ($user, $calculateProgress) {
            $progress = $calculateProgress($course, $user->id);
            $course->progress_percentage = $progress;
            return $progress >= 100;
        });

        // 3. Buat Paginator secara manual agar sama seperti halaman MyCourse
        $perPage = 8; // <-- Jumlah item per halaman, sama dengan MyCourse
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = $completedCoursesCollection->slice(($currentPage - 1) * $perPage, $perPage)->values();

        $paginatedCourses = new LengthAwarePaginator(
            $currentItems,
            $completedCoursesCollection->count(),
            $perPage,
            $currentPage,
            // Opsi untuk memastikan link pagination membawa serta query string (filter)
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('user.history', [
            'courses' => $paginatedCourses, // Kirim hasil pagination ke view
            'categories' => $categories,
        ]);
    }
}
