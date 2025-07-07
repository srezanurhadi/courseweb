<?php

namespace App\Http\Controllers;

use DB;
use App\Models\User;
use App\Models\Course;
use App\Models\Content;
use App\Models\Category;
use App\Models\Enrollment;
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

        // Mengambil data enrollment per bulan untuk tahun 2025
        $currentYear = 2025;
        $monthlyEnrollments = Enrollment::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->whereYear('created_at', $currentYear)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->toArray();

        // Menyiapkan data untuk chart (1-12 bulan), bulan kosong = 0
        $chartData = [];
        for ($i = 1; $i <= 12; $i++) {
            $chartData[] = isset($monthlyEnrollments[$i]) ? (int)$monthlyEnrollments[$i] : 0;
        }

        // Mengambil data user berdasarkan role untuk pie chart
        $usersByRole = User::select('role', DB::raw('COUNT(*) as total'))
            ->whereIn('role', ['admin', 'author', 'participant'])
            ->groupBy('role')
            ->orderBy('total', 'desc')
            ->get();

        // Menyiapkan data untuk pie chart - hanya role yang memiliki user
        $roleLabels = [];
        $roleData = [];

        foreach ($usersByRole as $role) {
            $roleLabels[] = ucfirst($role->role); // admin -> Admin
            $roleData[] = $role->total;
        }
        return view('admin.dashboard', compact(
            'categories',
            'unusedContentCount',
            'ContentCount',
            'coursescount',
            'coursesactive',
            'coursesdraft',
            'popularCourses',
            'chartData',
            'roleLabels',
            'roleData'
        ));
    }
}
