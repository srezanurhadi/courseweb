<?php

namespace App\Http\Controllers;

use App\Models\MyParticipant;
use App\Models\Course;
use App\Models\Content;
use App\Models\Category;
use App\Models\enrollments as Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class myParticipantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.myParticipant.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(MyParticipant $myParticipant)
    {
        return view('admin.myParticipant.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MyParticipant $myParticipant)
    {
        return view('admin.myParticipant.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MyParticipant $myParticipant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MyParticipant $myParticipant)
    {
        //
    }

    /**
     * Menampilkan halaman profil utama milik participant.
     */
    public function showProfile()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user(); // Ambil data pengguna yang sedang login

        // Ambil semua kursus yang diikuti oleh user
        $enrolledCourses = $user->enrolledCourses()->with(['category', 'user'])->get();

        // Lakukan iterasi untuk menghitung progres setiap kursus
        foreach ($enrolledCourses as $course) {
            // Set progres default ke 0
            $course->progress_percentage = 0;

            // Ambil data enrollment yang spesifik untuk kursus ini
            $enrollment = $user->enrollments()->where('course_id', $course->id)->first();

            // Jika ada enrollment dan pernah membuka konten, hitung progresnya
            if ($enrollment && $enrollment->last_content_id) {
                $allContents = $course->contents()->get();
                $totalContents = $allContents->count();

                if ($totalContents > 0) {
                    $lastSeenContentIndex = $allContents->search(function ($content) use ($enrollment) {
                        return $content->id == $enrollment->last_content_id;
                    });

                    if ($lastSeenContentIndex !== false) {
                        $completedContentsCount = $lastSeenContentIndex + 1;
                        $course->progress_percentage = round(($completedContentsCount / $totalContents) * 100);
                    }
                }
            }
        }

        // Kirim data user DAN data kursus yang sudah dihitung progresnya ke view
        return view('user.myprofile.index', compact('user', 'enrolledCourses'));
    }

    /**
     * Menampilkan halaman untuk mengedit profil.
     */
    public function editProfile()
    {
        $user = Auth::user(); // Ambil data pengguna yang sedang login
        return view('user.myprofile.edit', compact('user')); // Kirim data ke view 'edit'
    }

    /**
     * Method lain bisa ditambahkan di sini nanti jika perlu.
     */
    public function updateProfile(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Validasi, tambahkan aturan untuk 'image'
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'no_telp' => 'required|string|min:10|max:15',
            'password' => 'nullable|string|min:8',
            'image' => 'nullable|image|file|max:2048', // Boleh kosong, harus gambar, maks 2MB
            'delete_photo' => 'nullable|boolean', // Untuk flag hapus foto
        ]);

        // Proses password jika diisi
        if (!empty($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        } else {
            unset($validatedData['password']);
        }

        // PROSES FOTO PROFIL
        if ($request->has('delete_photo') && $request->delete_photo == '1') {
            // Hapus foto jika ada dan delete_photo bernilai true
            if ($user->image) {
                Storage::disk('public')->delete($user->image);
                $validatedData['image'] = null; // Set kolom image ke null
            }
        } elseif ($request->file('image')) {
            // Upload foto baru jika ada
            // 1. Hapus gambar lama jika ada
            if ($user->image) {
                Storage::disk('public')->delete($user->image);
            }
            // 2. Simpan gambar baru dan dapatkan path-nya
            $validatedData['image'] = $request->file('image')->store('profile-pictures', 'public');
        }

        // Update data pengguna
        $user->update($validatedData);

        return redirect()->route('user.profile')->with('success', 'Profile berhasil diperbarui!');
    }

    /**
     * Menampilkan halaman detail certificate untuk course yang sudah selesai.
     */
    public function showCourseDetail($id)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        
        // Ambil data course berdasarkan ID
        $course = Course::findOrFail($id);
        
        // Pastikan user sudah enroll di course ini
        $enrollment = $user->enrollments()->where('course_id', $course->id)->first();
        
        if (!$enrollment) {
            abort(404, 'Course not found or not enrolled');
        }
        
        // Hitung progress untuk memastikan sudah 100%
        $allContents = $course->contents()->get();
        $totalContents = $allContents->count();
        $progressPercentage = 0;
        
        if ($enrollment->last_content_id && $totalContents > 0) {
            $lastSeenContentIndex = $allContents->search(function ($content) use ($enrollment) {
                return $content->id == $enrollment->last_content_id;
            });
            
            if ($lastSeenContentIndex !== false) {
                $completedContentsCount = $lastSeenContentIndex + 1;
                $progressPercentage = round(($completedContentsCount / $totalContents) * 100);
            }
        }
        
        // Pastikan progress sudah 100% sebelum bisa melihat detail
        if ($progressPercentage < 100) {
            return redirect()->route('user.profile')->with('error', 'You need to complete the course first to view the certificate.');
        }
        
        // Kirim data course dan user ke view detail
        return view('user.myprofile.detail', compact('course', 'user', 'progressPercentage'));
    }

    /**
     * Menampilkan daftar kursus yang diikuti oleh participant.
     */
    public function myCourses(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $lastSeenCourse = null;
        $categories = Category::all();

        $isFilteringOrSearching = ($request->has('search') && $request->filled('search')) ||
            ($request->has('category') && $request->filled('category'));

        if (!$isFilteringOrSearching && $user->enrolledCourses()->exists()) {
            $lastEnrollment = Enrollment::where('user_id', $user->id)
                ->orderBy('updated_at', 'desc')
                ->first();

            if ($lastEnrollment) {
                $lastSeenCourse = Course::with(['category', 'user'])->withCount(['enrollments', 'contents'])->find($lastEnrollment->course_id);

                // === LOGIKA PROGRES UNTUK LAST SEEN COURSE ===
                $allContentsForLastSeen = $lastSeenCourse->contents()->get(); // Ambil semua konten yang terurut
                $totalContents = $allContentsForLastSeen->count();
                $lastSeenCourse->progress_percentage = 0; // Default progress 0

                if ($lastEnrollment->last_content_id && $totalContents > 0) {
                    // Cari index (posisi) dari konten yang terakhir dilihat
                    $lastSeenContentIndex = $allContentsForLastSeen->search(function ($content) use ($lastEnrollment) {
                        return $content->id == $lastEnrollment->last_content_id;
                    });

                    // Jika konten ditemukan, hitung progresnya
                    if ($lastSeenContentIndex !== false) {
                        $completedContentsCount = $lastSeenContentIndex + 1; // Index dimulai dari 0, jadi +1
                        $lastSeenCourse->progress_percentage = round(($completedContentsCount / $totalContents) * 100);
                    }
                }
                // ===============================================

                // Tambahkan informasi content terakhir yang dilihat (sudah ada di kode Anda)
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

        // === LOGIKA PROGRES UNTUK DAFTAR KURSUS LAINNYA ===
        foreach ($courses as $courseItem) {
            // Ambil data enrollment yang relevan
            $enrollment = Enrollment::where('user_id', $user->id)
                ->where('course_id', $courseItem->id)
                ->first();
            
            $courseItem->progress_percentage = 0; // Default progress 0

            if ($enrollment && $enrollment->last_content_id) {
                $allContents = $courseItem->contents()->get(); // Ambil semua konten yang terurut
                $totalContents = $allContents->count();

                if ($totalContents > 0) {
                    // Cari index dari konten yang terakhir dilihat
                    $lastSeenContentIndex = $allContents->search(function ($content) use ($enrollment) {
                        return $content->id == $enrollment->last_content_id;
                    });
                    
                    if ($lastSeenContentIndex !== false) {
                         $completedContentsCount = $lastSeenContentIndex + 1; // Index dimulai dari 0, jadi +1
                         $courseItem->progress_percentage = round(($completedContentsCount / $totalContents) * 100);
                    }
                }
            }
        }
        // ===============================================

        return view('user.mycourse.index', compact(
            'courses',
            'lastSeenCourse',
            'categories',
            'isFilteringOrSearching'
        ));
    }
}
