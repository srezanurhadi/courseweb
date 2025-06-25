<?php

namespace App\Http\Controllers;

use Log;
use App\Models\User;
use App\Models\Course;
use App\Models\Content;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\MyParticipant;
use App\Models\UserCourseProgress;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class myParticipantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Course::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%$search%")
                    ->orWhere('description', 'like', "%$search%");
            });
        }

        $query->withCount('enrollments');

        $courses = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        return view('admin.myParticipant.index', compact('courses'));
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
    // app/Http/Controllers/MyParticipantController.php
    public function show($slug)
    {
        $course = Course::where('slug', $slug)->firstOrFail();
        $courseId = $course->id;

        $userIds = DB::table('enrollments')
            ->where('course_id', $courseId)
            ->pluck('user_id');

        $enrolledUsers = User::whereIn('id', $userIds)->get();

        // Manual cara: ambil courses untuk setiap user
        foreach ($enrolledUsers as $user) {
            $userCourses = DB::table('enrollments')
                ->join('courses', 'enrollments.course_id', '=', 'courses.id')
                ->where('enrollments.user_id', $user->id)
                ->select('courses.id', 'courses.title', 'courses.slug')
                ->get();

            // Tambahkan sebagai attribute
            $user->enrolled_courses = $userCourses;
        }

        return view('admin.myParticipant.show', compact('course', 'enrolledUsers'));
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

        $calculateProgress = function ($course, $userId) {
            // Gunakan `contents_count` yang sudah di-load untuk efisiensi
            $totalContents = $course->contents_count;
            if ($totalContents === 0) {
                return 0;
            }
            // Hitung konten yang selesai dari tabel `user_course_progress`
            $completedContentsCount = UserCourseProgress::where('user_id', $userId)
                ->where('course_id', $course->id)
                ->count();
            return round(($completedContentsCount / $totalContents) * 100);
        };
        // Ambil semua kursus yang diikuti, dan hitung total kontennya (withCount)
        $enrolledCourses = $user->enrolledCourses()
            ->with(['category', 'user'])
            ->withCount('contents') // <-- PENTING: Untuk efisiensi
            ->get();

        // Lakukan iterasi untuk menghitung progres setiap kursus
        foreach ($enrolledCourses as $course) {
            // Panggil fungsi yang sudah kita siapkan
            $course->progress_percentage = $calculateProgress($course, $user->id);
        }

        // Kirim data user dan kursus yang sudah dihitung progresnya ke view
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
     * Menampilkan halaman detail sebuah course dari halaman profil.
     */
    public function showCourseDetail($id)
    {
        // Cari course berdasarkan ID. Jika tidak ditemukan, akan gagal (404 Not Found).
        $course = Course::findOrFail($id);

        // Kirim data course ke view
        return view('user.myprofile.detail', compact('course'));
    }
}
