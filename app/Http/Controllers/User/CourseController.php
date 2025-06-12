<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Category;
use Illuminate\Http\Request;

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
}
