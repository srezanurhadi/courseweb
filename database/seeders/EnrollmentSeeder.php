<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\enrollments;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EnrollmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Ambil semua user yang memiliki peran 'participant'
        // Sesuaikan 'role' dan 'participant' jika nama kolom/nilai Anda berbeda.
        $participants = User::where('role', 'participant')->get();

        // 2. Ambil semua course yang ada
        $courses = Course::all();

        // Cek apakah ada cukup participant untuk dijalankan
        if ($participants->count() < 5) {
            $this->command->info('Tidak cukup user dengan peran "participant" (diperlukan minimal 5). Seeder Enrollment dilewati.');
            return;
        }

        $this->command->info('Memulai proses seeding untuk tabel enrollments...');

        // 3. Loop untuk setiap course
        foreach ($courses as $course) {

            // Tentukan jumlah user yang akan didaftarkan ke course ini (minimal 5)
            // Angka maksimal tidak boleh lebih besar dari total participant yang ada
            $maxEnrollments = min(15, $participants->count()); // Contoh: maksimal 15 user per course
            $enrollmentCount = rand(5, $maxEnrollments);

            // 4. Ambil sejumlah user secara acak dan unik dari koleksi participants
            // Ini memastikan tidak ada user yang sama didaftarkan ke course yang sama
            $selectedUsers = $participants->random($enrollmentCount);

            // 5. Buat data enrollment untuk setiap user yang terpilih
            foreach ($selectedUsers as $user) {
                Enrollment::factory()->create([
                    'course_id' => $course->id,
                    'user_id' => $user->id,
                ]);
            }

            $this->command->info("{$enrollmentCount} user telah didaftarkan ke course: '{$course->name}'");
        }

        $this->command->info('Seeding untuk tabel enrollments selesai.');
    }
}
