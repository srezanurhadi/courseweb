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
        // Bagian query ini sudah benar dan bisa digunakan untuk kedua skenario
        $contentsQuery = Content::with('category')->orderBy('created_at', 'desc');

        // Handle search functionality
        if ($request->filled('search')) { // ->filled() lebih baik dari ->has()
            $contentsQuery->where('title', 'like', '%' . $request->search . '%');
        }

        // Handle category filter
        if ($request->filled('category')) {
            $contentsQuery->where('category_id', $request->category);
        }

        // Get the filtered contents
        $contents = $contentsQuery->get();

        // --- LOGIKA KONDISIONAL DIMULAI DI SINI ---

        // 1. Jika ini adalah permintaan AJAX dari JavaScript kita...
        if ($request->ajax()) {

            // Format data agar bersih dan sesuai untuk JSON
            $formattedContents = $contents->map(function ($content) {
                return [
                    'id' => $content->id,
                    'title' => $content->title,
                    'slug' => $content->slug,
                    'category_name' => $content->category->category,
                    'created_at' => $content->created_at->format('d-m-Y'),
                ];
            });

            // Kembalikan hanya data JSON
            return response()->json(['contents' => $formattedContents]);
        }

        // 2. Jika ini adalah permintaan biasa (load halaman pertama kali)...
        // maka lanjutkan kode Anda yang sebelumnya untuk merender view.

        $categories = Category::all();

        $contentDetails = [];
        foreach ($contents as $content) {
            $contentDetails[$content->id] = [
                'title' => $content->title,
                'blocks' => json_decode($content->content, true)['blocks'] ?? []
            ];
        }

        // Kembalikan view lengkap dengan semua data yang dibutuhkan
        return view('admin.course.create', compact('categories', 'contents', 'contentDetails'));
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

    public function search(Request $request)
    {
        $contentsQuery = Content::with('category')->orderBy('created_at', 'desc');

        if ($request->filled('search')) {
            $contentsQuery->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $contentsQuery->where('category_id', $request->category);
        }

        $contents = $contentsQuery->get();

        $formattedContents = $contents->map(function ($content) {
            return [
                'id' => $content->id,
                'title' => $content->title,
                'slug' => $content->slug,
                'category_name' => $content->category->category,
                'created_at' => $content->created_at->format('d-m-Y'),
            ];
        });

        return response()->json(['contents' => $formattedContents]);
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
