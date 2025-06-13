<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Content;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class courseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {


        $courses = Course::orderBy('updated_at', 'desc')->paginate(9)->onEachSide(1);


        return view('admin.course.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('category')->get();
        $contents = Content::orderBy('updated_at', 'desc')->paginate(10)->onEachSide(1);
        return view('admin.course.create', compact('categories', 'contents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {



        $validatedData = $request->validate([
            'title' => 'required|string|max:150|unique:courses,title',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'required|string',
            'category' => 'required|exists:categories,id',
            'status' => 'nullable',
            'selected_content_ids' => 'required|string'

        ]);


        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('course-images');
        }

        $validatedData['status'] = $request->has('status') ? 1 : 0;

        $validatedData['user_id'] = Auth::user()->id;

        $validatedData['category_id'] = $request->input('category');

        $validatedData['slug'] = Str::slug($request->input('title'));

        $course = Course::create($validatedData);

        // Ambil data dari hidden input JSON
        $selectedContentsJson = $request->input('selected_content_ids');
        $selectedContents = json_decode($selectedContentsJson, true);

        if (is_array($selectedContents)) {
            $syncData = [];

            foreach ($selectedContents as $item) {
                // Pastikan ada id dan order
                if (isset($item['id']) && isset($item['order'])) {
                    $syncData[$item['id']] = ['order' => $item['order']];
                }
            }

            // Simpan ke tabel pivot
            $course->contents()->attach($syncData);
        }

        return redirect("/admin/course")->with('success', 'Course Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        return view('admin.course.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        return view('admin.course.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        //
    }
}
