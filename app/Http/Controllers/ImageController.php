<?php

namespace App\Http\Controllers;

use App\Models\UploadedImage;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // Tambahkan Log
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException; // Tambahkan ini
use id;
use Illuminate\Support\Facades\Auth;

class ImageController extends Controller
{
    public function store(Request $request)
    {
        
        try {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:3048',
            ]);
            $file = $request->file('image');
            $path = $file->store('content_images', 'public');
            $url = Storage::url($path);

            UploadedImage::create([
                'filename' => $file->getClientOriginalName(),
                'path' => $path,
                'url' => $url,
                'uploaded_by' => Auth::id(),
            ]);

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
            ], 422);
        } catch (\Exception $e) {
            Log::error('Image upload failed: ' . $e->getMessage());
            return response()->json([
                'success' => 0,
                'message' => 'Server error: ' . $e->getMessage(),
            ], 500);
        }
    }
}
