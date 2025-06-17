<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Content;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class courseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $query = Course::query();
        $categories = Category::orderBy('category')->get();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%$search%")
                    ->orWhere('description', 'like', "%$search%");
            });
        }


        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->has('status') && $request->status !== '') {
            $status = $request->input('status');
            if ($status === '1' || $status === '0') {
                $query->where('status', $status); // Laravel otomatis konversi string '1'/'0' ke boolean
            }
        }

        // Eksekusi query dengan pagination
        $courses = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        // Kirim data ke view
        return view('admin.course.index', compact('courses', 'categories'));
    }


    public function create(Request $request)
    {
        $categories = Category::all();

        $contentsQuery = Content::query();

        // Handle search functionality
        if ($request->has('search') && $request->search != '') {
            $contentsQuery->where('title', 'like', '%' . $request->search . '%');
        }

        // Handle category filter
        if ($request->has('category') && $request->category != '') {
            $contentsQuery->where('category_id', $request->category);
        }

        // Get the filtered contents
        $contents = $contentsQuery->orderBy('created_at', 'desc')->get();

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

        $categories = Category::orderBy('category')->get();
        $contents = Content::orderBy('updated_at', 'desc')->paginate(10)->onEachSide(1);

        $course->load('contents');

        return view('admin.course.edit', compact('course', 'categories', 'contents'));
    }

    public function update(Request $request, Course $course)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category' => 'required|exists:categories,id',
            'selected_content_ids' => 'required|json',
            'status' => 'boolean',
        ]);

        $data = $validatedData;
        $data['slug'] = Str::slug($request->title);
        $data['category_id'] = $request->category;
        $data['status'] = $request->has('status') ? 1 : 0;

        if ($request->hasFile('image')) {
            if ($course->image) {
                Storage::disk('public')->delete($course->image);
            }
            $data['image'] = $request->file('image')->store('course_images', 'public');
        }

        $course->update($data);

        $selectedContents = json_decode($request->selected_content_ids, true);

        if (is_array($selectedContents)) {
            $syncData = [];
            foreach ($selectedContents as $item) {
                if (isset($item['id']) && isset($item['order'])) {
                    $syncData[$item['id']] = ['order' => $item['order']];
                }
            }
            $course->contents()->sync($syncData);
        } else {
            $course->contents()->sync([]);
        }

        return redirect('/admin/course')->with('success', 'Course berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        //
    }
}
