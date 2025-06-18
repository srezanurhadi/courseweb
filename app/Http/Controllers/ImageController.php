<?php

namespace App\Http\Controllers;

use App\Models\UploadedImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // Tambahkan Log
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException; // Tambahkan ini

class ImageController extends Controller
{
    public function store(Request $request)
    {
        try {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:3048',
            ]);

            $file = $request->file('image');
            $path = $file->store('public/content_images');
            $url = Storage::url($path);

            $filename = basename($path);
            $url = '/storage/content_images/' . $filename;

            UploadedImage::create([
                'filename' => $file->getClientOriginalName(),
                'path' => $path,
                'url' => $url,
            ]);

            // Jika semua berhasil, kembalikan respons sukses
            return response()->json([
                'success' => 1,
                'file' => [
                    'url' => $url,
                ]
            ]);
        } catch (ValidationException $e) {
            // Jika validasi gagal
            return response()->json([
                'success' => 0,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422); // 422 Unprocessable Entity

        } catch (\Exception $e) {
            // Untuk error lainnya (misal: gagal menyimpan file)
            // Log errornya agar bisa ditelusuri
            Log::error('Image upload failed: ' . $e->getMessage());

            // Kembalikan respons gagal yang dikenali Editor.js
            return response()->json([
                'success' => 0,
                'message' => 'Server error: ' . $e->getMessage(),
            ], 500);
        }
    }
}
