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

        // Logika yang sama persis dengan yang kita buat sebelumnya untuk history
        $enrolledCoursesQuery = $user->enrolledCourses()
            ->withCount(['enrollments', 'contents'])
            ->with(['category', 'user']);

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

        $enrolledCourses = $enrolledCoursesQuery->latest('enrollments.created_at')->get();

        $completedCourses = $enrolledCourses->filter(function ($course) use ($user) {
            $enrollment = $course->enrollments->where('user_id', $user->id)->first();
            if (!$enrollment || !$enrollment->last_content_id) {
                return false;
            }

            $totalContents = $course->contents_count;
            if ($totalContents == 0) {
                return false; // Anggap belum selesai jika tidak ada konten
            }

            $allContents = $course->contents()->get();
            $lastSeenContentIndex = $allContents->search(fn($content) => $content->id == $enrollment->last_content_id);

            if ($lastSeenContentIndex === false) {
                return false;
            }

            $completedContentsCount = $lastSeenContentIndex + 1;
            $progressPercentage = round(($completedContentsCount / $totalContents) * 100);

            $course->progress_percentage = $progressPercentage;

            return $progressPercentage >= 100;
        });

        return view('user.history', [
            'courses' => $completedCourses,
            'categories' => $categories
        ]);
    }
}
