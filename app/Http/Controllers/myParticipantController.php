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
        $user = Auth::user(); // Ambil data pengguna yang sedang login
        return view('user.myprofile.index', compact('user')); // Kirim data ke view 'index'
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
     * Menampilkan daftar kursus yang diikuti oleh participant.
     */
    public function myCourses(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $lastSeenCourse = null;
        $categories = Category::all();

        // Cek apakah ada filter atau search yang aktif.
        $isFilteringOrSearching = ($request->has('search') && $request->filled('search')) ||
            ($request->has('category') && $request->filled('category'));

        // Hanya ambil 'lastSeenCourse' jika TIDAK sedang memfilter atau mencari
        // dan user memiliki setidaknya satu enrollment.
        if (!$isFilteringOrSearching && $user->enrolledCourses()->exists()) {
            $lastEnrollment = Enrollment::where('user_id', $user->id)
                // Urutkan berdasarkan updated_at DESC, untuk mendapatkan enrollment yang terakhir di-interaksi
                ->orderBy('updated_at', 'desc')
                ->first();

            if ($lastEnrollment) {
                // Load kursus terkait, termasuk category dan user (author)
                $lastSeenCourse = Course::with(['category', 'user'])->withCount('enrollments')->find($lastEnrollment->course_id);

                // Tambahkan informasi content terakhir yang dilihat jika ada
                if ($lastEnrollment->last_content_id) {
                    $lastSeenContent = Content::find($lastEnrollment->last_content_id);
                    if ($lastSeenContent) {
                        $lastSeenCourse->last_seen_content_title = $lastSeenContent->title;
                        $lastSeenCourse->last_seen_content_id = $lastSeenContent->id;
                    }
                } else {
                    // Jika last_content_id adalah null (berarti terakhir dilihat overview),
                    // kita bisa set penanda khusus atau default.
                    $lastSeenCourse->last_seen_content_title = 'Overview'; // Atau pesan lain
                    $lastSeenCourse->last_seen_content_id = null; // menandakan overview
                }

                // Ambil semua konten untuk kursus terakhir dilihat untuk menghitung progress.
                // Ini penting untuk menampilkan "progress" di kartu last seen.
                $allContentsForLastSeen = $lastSeenCourse->contents()->get();
                $totalContents = $allContentsForLastSeen->count();

                // Contoh sederhana untuk menghitung progress:
                // Anda bisa mengembangkan ini dengan tabel terpisah untuk "completed content"
                // Saat ini, kita asumsikan jika last_content_id ada, itu berarti progress > 0
                if ($lastSeenCourse->last_seen_content_id && $totalContents > 0) {
                    $lastSeenContentIndex = $allContentsForLastSeen->search(function ($content) use ($lastSeenCourse) {
                        return $content->id == $lastSeenCourse->last_seen_content_id;
                    });
                    $completedContentsCount = $lastSeenContentIndex + 1; // Asumsi semua konten sebelumnya sudah selesai
                    $lastSeenCourse->progress_percentage = round(($completedContentsCount / $totalContents) * 100);
                } else if ($lastSeenCourse->last_seen_content_id === null && $totalContents > 0) {
                    // Jika hanya overview yang dilihat, tapi ada konten, set progress ke 0.
                    $lastSeenCourse->progress_percentage = 0;
                } else {
                    // Jika tidak ada konten sama sekali atau belum ada last_content_id
                    $lastSeenCourse->progress_percentage = 0;
                }
            }
        }

        // Query dasar untuk semua kursus yang diikuti user (kecuali lastSeenCourse jika ada)
        $enrolledCoursesQuery = $user->enrolledCourses()->withCount('enrollments')->with(['category', 'user']);

        // Hanya kecualikan 'lastSeenCourse' dari daftar utama jika 'lastSeenCourse' ada dan tidak dalam mode filtering/searching.
        if ($lastSeenCourse && !$isFilteringOrSearching) {
            $enrolledCoursesQuery->where('courses.id', '!=', $lastSeenCourse->id);
        }

        // Terapkan filter kategori jika ada
        if ($request->has('category') && $request->filled('category')) {
            $enrolledCoursesQuery->where('category_id', $request->category);
        }

        // Terapkan filter pencarian jika ada
        if ($request->has('search') && $request->filled('search')) {
            $searchTerm = $request->search;
            $enrolledCoursesQuery->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', '%' . $searchTerm . '%')
                    ->orWhere('description', 'like', '%' . $searchTerm . '%');
            });
        }

        // Urutkan berdasarkan waktu pendaftaran terbaru
        $courses = $enrolledCoursesQuery->latest('enrollments.created_at')->paginate(8);

        // Perhitungan progress untuk kursus di daftar `courses` (bukan lastSeenCourse)
        foreach ($courses as $courseItem) {
            $enrollment = $user->enrolledCourses()->where('course_id', $courseItem->id)->first();
            if ($enrollment && $enrollment->last_content_id) {
                $allContents = $courseItem->contents()->get(); // Get ordered contents for this course
                $totalContents = $allContents->count();
                $lastSeenContentIndex = $allContents->search(function ($content) use ($enrollment) {
                    return $content->id == $enrollment->last_content_id;
                });
                if ($totalContents > 0) {
                    $completedContentsCount = $lastSeenContentIndex + 1;
                    $courseItem->progress_percentage = round(($completedContentsCount / $totalContents) * 100);
                } else {
                    $courseItem->progress_percentage = 0;
                }
            } else {
                $courseItem->progress_percentage = 0; // Atau 0% jika baru di-enroll / belum ada konten spesifik
            }
        }


        return view('user.mycourse.index', compact(
            'courses',
            'lastSeenCourse',
            'categories',
            'isFilteringOrSearching'
        ));
    }
}
