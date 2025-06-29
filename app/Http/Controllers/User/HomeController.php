<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserCourseProgress;

class HomeController extends Controller
{
    /**
     * Menampilkan halaman home untuk participant dengan data progres.
     */
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Ambil semua kursus yang diikuti oleh user, beserta jumlah total konten di setiap kursus
        $enrolledCourses = $user->enrolledCourses()->where('status', 1)->withCount('contents')->get();

        $finishedCourseCount = 0;
        $totalProgress = 0;
        $totalCourses = $enrolledCourses->count();

        if ($totalCourses > 0) {
            foreach ($enrolledCourses as $course) {
                $totalContents = $course->contents_count; // Menggunakan hasil dari withCount
                if ($totalContents > 0) {
                    $completedContentsCount = UserCourseProgress::where('user_id', $user->id)
                        ->where('course_id', $course->id)
                        ->count();

                    $progress = round(($completedContentsCount / $totalContents) * 100);

                    if ($progress >= 100) {
                        $finishedCourseCount++;
                    }
                    $totalProgress += $progress;
                }
            }
        }

        $ongoingCourseCount = $totalCourses - $finishedCourseCount;
        $ongoingCourseCountPercentage = ($totalCourses > 0) ? round(($ongoingCourseCount / $totalCourses) * 100) : 0;
        $overallProgress = ($totalCourses > 0) ? round($totalProgress / $totalCourses) : 0;
        $finishedCoursePercentage = ($totalCourses > 0) ? round(($finishedCourseCount / $totalCourses) * 100) : 0;

        return view('user.home', [
            'finishedCourseCount' => $finishedCourseCount,
            'ongoingCourseCount' => $ongoingCourseCount,
            'overallProgress' => $overallProgress,
            'totalEnrolledCourses' => $totalCourses,
            'finishedCoursePercentage' => $finishedCoursePercentage,
            'ongoingCourseCountPercentage' => $ongoingCourseCountPercentage,
        ]);
    }
}
