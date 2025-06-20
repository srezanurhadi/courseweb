<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Category;
use App\Models\UploadedImage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class contentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $contents = Content::with('category')->orderBy('updated_at', 'desc')->paginate(10)->onEachSide(1);
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

    public function show(string $slug,)
    {
        $content = Content::where('slug', $slug)->first();
        $contentData = $content->content;
        $editorJsData = json_decode($contentData, true);
        return view('admin.content.show', compact('content', 'editorJsData'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {

        $content = Content::where('slug', $slug)->firstOrFail();
        $categories = Category::all();

        $editorJsData = null;
        if ($content->content) {
            if (is_string($content->content)) {
                $editorJsData = json_decode($content->content);
            } else {
                $editorJsData = $content->content;
            }
        }

        return view('admin.content.edit', compact('content', 'categories', 'editorJsData'));
    }


    public function update(Request $request, string $slug)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:150',
            'content' => 'required|json',
            'category' => 'required|exists:categories,id',
        ]);

        
        DB::beginTransaction();

        try {
            $content = Content::where('slug', $slug)->firstOrFail();

            // 2. Logika untuk mengupdate slug jika judul berubah (kode Anda sudah bagus)
            if ($content->title !== $validatedData['title']) {
                $newSlug = Str::slug($validatedData['title']);
                $uniqueSlug = $newSlug;
                $counter = 1;
                while (Content::where('slug', $uniqueSlug)->where('id', '!=', $content->id)->exists()) {
                    $uniqueSlug = $newSlug . '-' . $counter;
                    $counter++;
                }
                $content->slug = $uniqueSlug;
            }

            // 3. Update data utama konten
            $content->title = $validatedData['title'];
            $content->content = $validatedData['content'];
            $content->category_id = $validatedData['category'];
            $content->save();


            $contentJson = json_decode($validatedData['content'], true);
            $newImageUrlsInContent = [];
            foreach (($contentJson['blocks'] ?? []) as $block) {
                if ($block['type'] === 'image' && isset($block['data']['file']['url'])) {
                    $newImageUrlsInContent[] = $block['data']['file']['url'];
                }
            }

            // 5. Dapatkan URL gambar yang saat ini terhubung dengan konten
            $currentAssociatedUrls = $content->images()->pluck('url')->toArray();

            // 6. Tentukan gambar mana yang harus dihapus
            $urlsToDelete = array_diff($currentAssociatedUrls, $newImageUrlsInContent);

            // dd(
            //     'GAMBAR YANG TERHUBUNG DI DB SAAT INI:',
            //     $currentAssociatedUrls,
            //     'GAMBAR DI FORM SETELAH DIEDIT:',
            //     $newImageUrlsInContent,
            //     'GAMBAR YANG AKAN DIHAPUS (HASIL PERBANDINGAN):',
            //     $urlsToDelete
            // );

            // GANTI SELURUH BLOK IF INI DENGAN YANG BARU
            // GANTI LAGI SELURUH BLOK IF INI DENGAN YANG BENAR
            if (!empty($urlsToDelete)) {

                // --- PERBAIKAN UTAMA ADA DI BARIS INI ---
                // Kita kembali menggunakan whereIn dengan variabel array $urlsToDelete yang sudah terbukti benar.
                $imagesToDelete = UploadedImage::whereIn('url', $urlsToDelete)->get();

                // Logika di bawah ini sudah benar dan tidak perlu diubah
                foreach ($imagesToDelete as $image) {
                    try {
                        // 1. Mengubah URL lengkap menjadi path yang dikenali oleh Storage
                        $urlPath = parse_url($image->url, PHP_URL_PATH);
                        $storagePath = str_replace('/storage/', '', $urlPath);

                        // 2. Hapus file fisik dari storage
                        if (Storage::disk('public')->exists($storagePath)) {
                            Storage::disk('public')->delete($storagePath);
                        }
                    } catch (\Exception $e) {
                        // Jika gagal menghapus file, catat error tapi jangan hentikan proses.
                        Log::error("Gagal menghapus file fisik: {$image->url}. Error: " . $e->getMessage());
                    }

                    // 3. Hapus record dari database.
                    $image->delete();
                }
            }

            // 7. Tentukan gambar baru yang harus dihubungkan
            // (Gambar yang ada di konten baru, tapi belum punya relasi ke konten ini)
            if (!empty($newImageUrlsInContent)) {
                UploadedImage::whereIn('url', $newImageUrlsInContent)
                    ->where(function ($query) use ($content) {
                        $query->where('imageable_id', '!=', $content->id)
                            ->orWhereNull('imageable_id');
                    })
                    ->update([
                        'imageable_id' => $content->id,
                        'imageable_type' => Content::class,
                    ]);
            }

            // Jika semua proses berhasil, commit perubahan ke database
            DB::commit();

            return redirect('/admin/content')->with('success', 'Konten berhasil diperbarui!');
        } catch (\Exception $e) {
            // Jika ada kesalahan di tengah jalan, batalkan semua perubahan
            DB::rollBack();
            Log::error('Update Konten Gagal: ' . $e->getMessage()); // Catat error untuk debug

            return back()->with('error', 'Terjadi kesalahan saat memperbarui konten.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Content $content)
    {
        //
    }
}
