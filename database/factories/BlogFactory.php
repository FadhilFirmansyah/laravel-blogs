<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "title" => $this->faker->sentence(mt_rand(1, 3)),
            "slug" => $this->faker->unique()->slug(),
            "user_id" => mt_rand(1, 5),
            "category_id" => mt_rand(1, 3),
            "excerpt" => $this->faker->paragraph(),
            "body" => collect($this->faker->paragraphs(mt_rand(4, 7)))
                        ->map(fn($p) => "<p>$p</p>")
                        ->implode("")
        ];
    }
}
