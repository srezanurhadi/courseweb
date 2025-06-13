<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseContentSeeder extends Seeder
{
    public function run()
    {
        $courses = DB::table('courses')->pluck('id'); 
        $contents = DB::table('content')->pluck('id'); 

        foreach ($courses as $courseId) {
 
            $randomContentIds = $contents->random(3);

            $orders = collect([1, 2, 3])->shuffle(); 

            foreach ($randomContentIds as $index => $contentId) {
                DB::table('course_contents')->insert([
                    'course_id' => $courseId,
                    'content_id' => $contentId,
                    'order' => $orders[$index],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
