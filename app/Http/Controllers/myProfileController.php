<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Category;
use App\Models\myProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
        return view('admin.myProfile.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        // Validasi input
        $user = User::where('id', $id)->first();

        $oldimage = $user->image;

        $rules = [
            'name' => 'required|string|max:255',
            'no_telp' => 'nullable|numeric|digits_between:10,15',
            'image' => 'nullable|string|mimes:jpeg,png,jpg|max:2048',
            'delete_photo' => 'nullable|boolean'
        ];

        // Tambahkan rules password hanya jika diisi
        if ($request->filled('password')) {
            $rules['password'] = 'string|min:8';
            $rules['password_confirmation'] = 'required|string|min:8|same:password';
        }

        $validatedData = $request->validate($rules);

        // Update nama
        $user->name = $validatedData['name'];

        // Update nomor telepon
        $user->no_telp = $validatedData['no_telp'];

        // Update password jika diisi
        if (!empty($validatedData['password'])) {
            $user->password = Hash::make($validatedData['password']);
        }

        // Handle upload gambar
        if ($request->file('image')) {
            if ($oldimage) {
                Storage::delete($oldimage);
            }
            // Simpan path ke kolom image
            $user->image = $request->file('image')->store('profile-picture');
        }

        // Handle penghapusan foto
        if ($request->input('delete_photo') == '1') {
            // Hapus gambar dari storage jika ada
            if ($user->image && Storage::exists('public/profile-pictures/' . $user->image)) {
                Storage::delete('public/profile-pictures/' . $user->image);
            }

            // Set image ke null
            $user->image = null;
        }

        // Simpan perubahan
        $user->save();

        // Redirect dengan pesan sukses
        return redirect("/admin/myprofile")->with('Profile updated successfully', 'Profile ');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(myProfile $myProfile)
    {
        //
    }
}
