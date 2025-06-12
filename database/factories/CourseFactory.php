<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence(4);
        $author = User::where('role', 'author')->inRandomOrder()->first();

        // 1. Buat array besar dengan distribusi yang diinginkan
        $roles = array_merge(
            array_fill(0, 80, 'participant'), // 80%
            array_fill(0, 15, 'author'),      // 15%
            array_fill(0, 5, 'admin')         // 5%
        );

        return [
            // Kita tidak perlu mengambil ID di sini, Laravel bisa melakukannya
            // jika relasi sudah didefinisikan dengan benar.
            
            'category_id' => Category::inRandomOrder()->first()->id,

            // Data Utama
            'user_id' => $author->id,
            'title' => $title,
            'slug' => Str::slug($title),
            'description' => $this->faker->sentence(15),
            'image' => $this->faker->imageUrl(640, 480, 'course', true),

            // Metadata & Status
            'status' => $this->faker->boolean(80),
        ];
    }
}
