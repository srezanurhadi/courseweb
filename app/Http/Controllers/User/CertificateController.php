<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Course;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CertificateController extends Controller
{
    /**
     * Menampilkan preview sertifikat sebagai HTML.
     */
    public function previewCertificate($courseId)
    {
        // 1. Ambil data yang dibutuhkan
        $user = Auth::user();
        $course = Course::with('user')->findOrFail($courseId); // 'user' adalah relasi ke author

        // 2. Siapkan data untuk dikirim ke view
        $data = [
            'userName'       => $user->name,
            'courseTitle'    => $course->title,
            'authorName'     => $course->user->name, // Mengambil nama author dari relasi
            'completionDate' => Carbon::now()->isoFormat('D MMMM YYYY'), // Format tanggal Indonesia
        ];

        // 3. Kembalikan view sertifikat secara langsung (bukan sebagai PDF)
        return view('user.certificate-preview', $data);
    }

    public function generateCertificate($courseId)
    {
        // 1. Ambil data yang dibutuhkan
        $user = Auth::user();
        $course = Course::with('user')->findOrFail($courseId); // 'user' adalah relasi ke author

        // 2. Logika untuk memastikan hanya peserta yang sudah selesai yang bisa download
        // (Anda bisa menyesuaikan logika ini sesuai kebutuhan)
        // Untuk contoh ini, kita asumsikan jika bisa akses route, maka berhak dapat sertifikat.

        // 3. Siapkan data untuk dikirim ke view
        $data = [
            'userName'       => $user->name,
            'courseTitle'    => $course->title,
            'authorName'     => $course->user->name, // Mengambil nama author dari relasi
            'completionDate' => Carbon::now()->isoFormat('D MMMM YYYY'), // Format tanggal Indonesia
        ];

        // 4. Load view dan data, lalu ubah menjadi PDF
        $pdf = PDF::loadView('user.certificate-pdf', $data);

        // Atur ukuran kertas agar sesuai dengan desain (misal: A4 landscape)
        $pdf->setPaper('a4', 'landscape');

        // 5. Buat nama file yang unik dan stream (download) PDF
        $fileName = 'sertifikat-' . Str::slug($course->title) . '-' . Str::slug($user->name) . '.pdf';
        return $pdf->stream($fileName);
    }
}
