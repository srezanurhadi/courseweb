<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Content;
use App\Models\Category;
use Illuminate\Http\Request;

class homecontroller extends Controller
{
    public function index()
    {
        $unusedContentCount = Content::doesntHave('courses')->count();
        $ContentCount = Content::all()->count();
        $categories = Category::all()->count();
        $coursescount = Course::all()->count();
        $coursesactive = Course::where('status', 1)->count();
        $coursesdraft = Course::where('status', 0)->count();

        $popularCourses = Course::withCount('enrollments')
            ->with('category') // Eager load category untuk mendapatkan icon dan warna
            ->orderBy('enrollments_count', 'desc')
            ->take(3)
            ->get();

        return view('admin.dashboard', compact('categories', 'unusedContentCount', 'ContentCount', 'coursescount', 'coursesactive', 'coursesdraft', 'popularCourses'));
    }
}
