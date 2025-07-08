<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Category;
use App\Models\myProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class myProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $categories = Category::all();

        $createdCourses = Course::withCount('contents', 'enrollments')
            ->with('category')
            ->where('user_id', $user->id)
            ->get();

        $totalCourses = $createdCourses->count();

        return view('admin.myProfile.index', compact('user', 'createdCourses', 'totalCourses'));
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
    public function show(myProfile $myProfile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(myProfile $myProfile)
    {
        $user = Auth::user();
        $categories = Category::all();
        return view('admin.myProfile.edit', compact('user', ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, myProfile $myProfile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(myProfile $myProfile)
    {
        //
    }
}
