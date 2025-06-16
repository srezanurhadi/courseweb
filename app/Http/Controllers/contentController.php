<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Category;
use App\Models\UploadedImage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class contentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $contents = Content::orderBy('updated_at', 'desc')->paginate(10)->onEachSide(1);
        return view('admin.content.index', compact('contents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('category')->get();
        return view('admin.content.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi data input dari form
        $validatedData = $request->validate([
            'title' => 'required|string|max:150',
            'content' => 'required|json',
            'category' => 'required|exists:categories,id',
        ]);

        // Siapkan data utama untuk disimpan ke tabel 'content'
        $dataToCreate = [
            'title'       => $validatedData['title'],
            'content'     => $validatedData['content'],
            'category_id' => $validatedData['category'],
            'created_by'  => Auth::id(),
            // Kolom 'image' sengaja tidak diisi sesuai permintaan Anda
        ];

        // Buat slug yang unik
        $slug = Str::slug($dataToCreate['title']);
        $uniqueSlug = $slug;
        $counter = 1;
        while (Content::where('slug', $uniqueSlug)->exists()) {
            $uniqueSlug = $slug . '-' . $counter;
            $counter++;
        }
        $dataToCreate['slug'] = $uniqueSlug;

        // 2. Simpan konten ke database
        $content = Content::create($dataToCreate);

        // 3. Hubungkan gambar-gambar dari Editor.js dengan konten yang baru dibuat
        $contentJson = json_decode($validatedData['content'], true);
        $imageUrls = [];

        // Loop sekali untuk mengumpulkan semua URL gambar dari dalam konten
        foreach (($contentJson['blocks'] ?? []) as $block) {
            if ($block['type'] === 'image' && isset($block['data']['file']['url'])) {
                $imageUrls[] = $block['data']['file']['url'];
            }
        }

        // Jika ada gambar di dalam konten, cari dan hubungkan semuanya
        if (!empty($imageUrls)) {
            // Ambil semua record gambar yang relevan dengan SATU query database
            $imagesToAssociate = UploadedImage::whereIn('url', $imageUrls)->get();

            // Hubungkan semua gambar yang ditemukan dengan konten ini
            if ($imagesToAssociate->isNotEmpty()) {
                $content->images()->saveMany($imagesToAssociate);
            }
        }

        // 4. Redirect dengan pesan sukses
        return redirect('/admin/content')
            ->with('success', 'Konten Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Content $content)
    {
        return view('admin.content.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Content $content)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Content $content)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Content $content)
    {
        //
    }
}
