<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Panggil Factory untuk membuat 20 course.
        // Factory akan mengurus semua detail pembuatan data palsunya.
        Course::factory()->count(20)->create();
    }
}