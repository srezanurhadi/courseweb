<?php

namespace App\Http\Controllers\User;

use App\Models\Course;
use App\Models\Content;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\UserCourseProgress;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\enrollments as Enrollment;

class CourseController extends Controller
{
    /**
     * Menampilkan daftar semua course.
     */
    public function index(Request $request)
    {
        $categories = Category::all();
        $query = Course::with(['category', 'user'])->withCount(['enrollments', 'contents'])->where('status', 1);

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

        // HITUNG PROGRES JIKA USER LOGIN
        if (Auth::check()) {
            /** @var \App\Models\User $user */
            $user = Auth::user();

            // Ambil semua ID kursus yang sudah diikuti user
            $enrolledCourseIds = $user->enrolledCourses()->pluck('courses.id')->toArray();

            // Fungsi untuk menghitung progres
            $calculateProgress = function ($course, $userId) {
                // Gunakan contents_count yang sudah di-load untuk efisiensi
                $totalContents = $course->contents_count;
                if ($totalContents === 0) {
                    return 0;
                }
                $completedContentsCount = UserCourseProgress::where('user_id', $userId)
                    ->where('course_id', $course->id)
                    ->count();
                return round(($completedContentsCount / $totalContents) * 100);
            };

            // Tambahkan persentase progres ke setiap kursus yang diikuti user
            foreach ($courses as $course) {
                if (in_array($course->id, $enrolledCourseIds)) {
                    $course->progress_percentage = $calculateProgress($course, $user->id);
                }
            }
        }

        return view('user.course.index', [
            'courses' => $courses,
            'categories' => $categories
        ]);
    }

    /**
     * Menampilkan halaman detail sebuah course.
     * Menggunakan Route Model Binding dengan 'slug'.
     */
    public function show(Course $course, Request $request)
    {
        if (!$course->status) {
            return redirect()->route('user.course.index')->with('error', 'Kursus tidak ditemukan.');
        }

        $isEnrolled = false;
        $enrollment = null;
        $progressPercentage = 0;
        $completedContentIds = []; // Inisialisasi array kosong untuk ID konten yang selesai

        if (Auth::check()) {
            /** @var \App\Models\User $user */
            $user = Auth::user();

            $enrollment = Enrollment::where('user_id', Auth::id())
                ->where('course_id', $course->id)
                ->first();
            $isEnrolled = (bool) $enrollment;

            if ($isEnrolled) {
                // === LOGIKA PROGRES BARU ===
                $totalContents = $course->contents()->count();
                if ($totalContents > 0) {
                    // Ambil semua ID konten yang sudah diselesaikan oleh user di kursus ini
                    $completedContentIds = $user->progress()
                        ->where('course_id', $course->id)
                        ->pluck('content_id')
                        ->toArray();

                    $completedContentsCount = count($completedContentIds);
                    $progressPercentage = round(($completedContentsCount / $totalContents) * 100);
                }
                // ===========================

                // Update timestamp 'updated_at' di enrollment untuk fitur "Last Seen"
                if ($enrollment) {
                    $enrollment->touch();
                }
            }
        }

        // Ambil semua konten yang diurutkan
        $allContents = $course->contents()->get();
        $limitedContents = $allContents;

        if ($enrollment) {
            $enrollment->touch();
        }

        $from = $request->query('from');

        // Kirim semua variabel, TERMASUK $completedContentIds
        return view('user.course.overview', compact('course', 'isEnrolled', 'from', 'progressPercentage', 'completedContentIds', 'allContents', 'limitedContents'));
    }

    /**
     * Menampilkan halaman detail sebuah konten dari sebuah course.
     * Updated untuk mendukung pagination
     */
    public function showContent(Course $course, $contentId, Request $request)
    {
        $isEnrolled = false;
        $enrollment = null; // Inisialisasi enrollment
        if (Auth::check()) {
            $enrollment = Enrollment::where('user_id', Auth::id())
                ->where('course_id', $course->id)
                ->first(); // Ambil objek enrollment
            $isEnrolled = (bool) $enrollment;
        }

        // Ambil semua konten kursus yang terkait dengan course ini, diurutkan.
        // Gunakan relasi `contents()` yang sudah ada di model Course untuk memastikan urutan pivot.
        $allContents = $course->contents()->get(); // Menggunakan relasi BelongsToMany dengan pivot 'order'

        $currentContent = null;
        if ($allContents->isNotEmpty()) {
            $currentContent = $allContents->firstWhere('id', $contentId);
        }

        if (!$currentContent) {
            abort(404, 'Content not found');
        }

        // Jika tidak ada konten dinamis atau konten tidak ditemukan, gunakan konten statis.
        // Ini adalah fallback dari kode Anda yang sudah ada.
        if (!$currentContent) {
            $staticContents = collect([
                (object)['id' => 1, 'title' => 'Content 1', 'content' => 'Lorem ipsum dolor sit amet...'],
                (object)['id' => 2, 'title' => 'Content 2', 'content' => 'Consectetur adipiscing elit...'],
                (object)['id' => 3, 'title' => 'Content 3', 'content' => 'Sed do eiusmod tempor...'],
                (object)['id' => 4, 'title' => 'Content 4', 'content' => 'Incididunt ut labore et dolore...'],
                (object)['id' => 5, 'title' => 'Content 5', 'content' => 'Magna aliqua. Ut enim ad minim...'],
                (object)['id' => 6, 'title' => 'Content 6', 'content' => 'Veniam, quis nostrud exercitation...'],
            ]);
            $currentContent = $staticContents->firstWhere('id', $contentId);
            if (!$currentContent) {
                abort(404, 'Content not found');
            }
            $allContents = $staticContents; // Update allContents juga untuk pagination statis
        }

        // Jika user terdaftar dan content berhasil ditemukan, update last_content_id
        if ($isEnrolled && $currentContent) {
            // Pastikan ada objek enrollment sebelum mencoba mengupdate
            if ($enrollment) {
                $enrollment->last_content_id = $currentContent->id;
                $enrollment->save();
            }
            // updateOrCreate akan membuat record jika belum ada, atau membiarkannya jika sudah ada.
            // Ini memastikan progress tidak bisa mundur.
            UserCourseProgress::updateOrCreate(
                [
                    'user_id' => Auth::id(),
                    'course_id' => $course->id,
                    'content_id' => $currentContent->id,
                ]
            );
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
            'all_contents' => $allContents // Kirim semua konten untuk membangun paginasi
        ];

        $from = $request->query('from');

        return view('user.course.content', compact('course', 'currentContent', 'from', 'isEnrolled', 'pagination'));
    }
}
