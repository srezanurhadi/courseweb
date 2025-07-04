<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CertificateController extends Controller
{
    /**
     * [BARU] Fungsi privat untuk mengambil data sertifikat.
     * Dibuat agar tidak ada duplikasi kode antara preview dan generate.
     */
    private function getCertificateData($courseId)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $course = Course::with('user')->findOrFail($courseId); // 'user' adalah relasi ke author

        //Ambil data pendaftaran untuk mendapatkan tanggal selesai
        $enrollment = Enrollment::where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->first();

        // Tentukan tanggal sertifikat.
        // Jika completion_date ada, gunakan tanggal itu.
        // Jika tidak ada (fallback), gunakan tanggal hari ini.
        $completionDate = $enrollment && $enrollment->completion_date
            ? Carbon::parse($enrollment->completion_date)->isoFormat('D MMMM YYYY')
            : Carbon::now()->isoFormat('D MMMM YYYY');

        // Kembalikan semua data yang dibutuhkan
        return [
            'userName'       => $user->name,
            'courseTitle'    => $course->title,
            'authorName'     => $course->user->name,
            'completionDate' => $completionDate,
        ];
    }

    /**
     * Menampilkan preview sertifikat sebagai HTML.
     */
    public function previewCertificate($courseId)
    {
        $data = $this->getCertificateData($courseId);
        return view('user.certificate-preview', $data);
    }

    public function generateCertificate($courseId)
    {
        $data = $this->getCertificateData($courseId);

        // Load view dan data, lalu ubah menjadi PDF
        $pdf = PDF::loadView('user.certificate-pdf', $data);
        $pdf->setPaper('a4', 'landscape');

        // Buat nama file yang unik dan stream (download) PDF
        $fileName = 'sertifikat-' . Str::slug($data['courseTitle']) . '-' . Str::slug($data['userName']) . '.pdf';
        return $pdf->stream($fileName);
    }
}
