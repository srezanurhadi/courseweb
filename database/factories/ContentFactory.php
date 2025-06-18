<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Content>
 */
class ContentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $title = $this->faker->sentence(4);
        $author = User::where('role', 'author')->inRandomOrder()->first();;


        return [
            'category_id' => Category::inRandomOrder()->first()->id,

            'created_by' => $author->id,
            'title' => $title,
            'slug' => Str::slug($title),
            'content' => $this->faker->text(200),
        ];
    }
}
