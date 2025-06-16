<?php

namespace Database\Factories;

use App\Models\User;
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
            'created_by' => $author->id,
            'title' => $title,
            'content' => $this->faker->text(200),
        ];
    }
}
