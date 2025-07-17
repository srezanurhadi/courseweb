<?php

namespace App\Http\Controllers;

use id;
use App\Models\Course;
use App\Models\Content;
use App\Models\Category;
use App\Models\enrollments;
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
        $querry = null;
        if ($request->is('*/mycourse*')) {
            $query = Course::where('user_id', Auth::id());
        } else {
            $query = Course::query();
        }

        $categories = Category::orderBy('category')->get();
        $coursescount = (clone $query)->count();
        $coursesactive = (clone $query)->where('status', 1)->count();
        $coursesdraft = (clone $query)->where('status', 0)->count();

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
        $query->withCount('enrollments');
        // Eksekusi query dengan pagination
        $courses = $query->orderBy('created_at', 'desc')->paginate(9)->withQueryString();
        // Kirim data ke view
        return view('admin.course.index', compact('courses', 'categories', 'coursescount', 'coursesactive', 'coursesdraft'));
    }


    public function create(Request $request)
    {
        $loggedInUserId = Auth::id();

        $contents = Content::with('category')
            ->where('created_by', $loggedInUserId) // <-- INI ADALAH FILTERNYA
            ->orderBy('created_at', 'desc')
            ->get();

        $categories = Category::all();

        // Kembalikan view lengkap dengan semua data yang dibutuhkan
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

        ], [
            'selected_content_ids.required' => 'You must select at least one content for this course.'
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

        $role = Auth::user()->role;
        if ($request->is('*/mycourse*')) {
            return redirect("/{$role}/mycourse")->with('success', 'Course berhasil Ditambahkan!');
        }
        return redirect("/{$role}/course")->with('success', 'Course Berhasil Ditambahkan');
    }

    public function search(Request $request)
    {
        $loggedInUserId = Auth::id();

        $contentsQuery = Content::with('category')
            ->where('created_by', $loggedInUserId)
            ->orderBy('created_at', 'desc');

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
                'category_color' => $content->category->color, 
                'category_icon' => $content->category->icon,
                'created_at' => $content->created_at->format('d-m-Y'),
            ];
        });

        return response()->json(['contents' => $formattedContents]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $course = Course::where('slug', $slug)->first();

        $course = Course::withCount('enrollments')->find($course->id);
        return view('admin.course.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {

        $loggedInUserId = Auth::id();

        $course = Course::where('slug', $slug)->firstOrFail();
        $categories = Category::orderBy('category')->get();
        $contents = Content::with('category')
            ->where('created_by', $loggedInUserId)
            ->orderBy('created_at', 'desc')
            ->get();

        $course->load('contents');

        return view('admin.course.edit', compact('course', 'categories', 'contents'));
    }

    public function update(Request $request, string $slug)
    {
        $course = Course::where('slug', $slug)->firstOrFail();
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
        $data['status'] = $request->input('status') == 1 ? 1 : 0;

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
        $role = Auth::user()->role;
        if ($request->is('*/mycourse*')) {
            return redirect("/{$role}/mycourse")->with('success', 'Course berhasil diperbarui!');
        }
        return redirect("/{$role}/course")->with('success', 'Course berhasil diperbarui!');
    }

    public function showContent(Course $course, $contentId, Request $request)
    {


        $allContents = $course->contents()->get(); // Menggunakan relasi BelongsToMany dengan pivot 'order'

        $currentContent = null;
        if ($allContents->isNotEmpty()) {
            $currentContent = $allContents->firstWhere('id', $contentId);
        }
        $editorJsData = json_decode($currentContent->content, true);
        // dd($editorJsData, $currentContent);
        // Find current content index
        $currentIndex = $allContents->search(function ($item) use ($contentId) {
            return $item->id == $contentId;
        });

        // Calculate pagination info
        $totalContents = $allContents->count();
        $currentPage = $currentIndex + 1;

        // Find previous and next content
        $previousContent = $currentIndex > 0 ? $allContents[$currentIndex - 1] : null;
        $nextContent = $currentIndex < $totalContents - 1 ? $allContents[$currentIndex + 1] : null;

        // Create pagination data
        $pagination = [
            'current_page' => $currentPage,
            'total_pages' => $totalContents,
            'has_previous' => $previousContent !== null,
            'has_next' => $nextContent !== null,
            'previous_content_id' => $previousContent ? $previousContent->id : null,
            'next_content_id' => $nextContent ? $nextContent->id : null,
            'all_contents' => $allContents // Kirim semua konten untuk membangun paginasi
        ];

        $from = $request->query('from');

        return view('admin.course.content', compact('course', 'editorJsData','currentContent', 'from', 'pagination'));
    }

   
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug, request $request)
    {
        $course = Course::where('slug', $slug)->firstOrFail();
        $role = Auth::user()->role;
        try {
            // 1. Hapus gambar dari storage jika ada
            if ($course->image && Storage::disk('public')->exists($course->image)) {
                Storage::disk('public')->delete($course->image);
            }
            // 2. Hapus relasi enrollments yang terkait
            $course->enrollments()->delete();
            // 3. Detach relasi dengan contents (hapus dari pivot table)
            $course->contents()->detach();
            // 4. Hapus course itu sendiri
            $course->delete();
            if ($request->is('*/mycourse*')) {
                return redirect("/{$role}/mycourse")->with('success', 'Course berhasil dihapus!');
            }
            return redirect("/{$role}/course")->with('success', 'Course berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect("/{$role}/course")->with('error', 'Gagal menghapus course. Silakan coba lagi.');
        }
    }
}
