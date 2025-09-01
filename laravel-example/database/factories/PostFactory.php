<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(10),
            'content' => fake()->paragraph(),
            'status' => true,
            'published_at' => fake()->dateTime(),
            'cover_image'=> 'https://placehold.co/600x400/000000/FFFFFF/png',
            'tags' => [fake()->sentence(1), fake()->sentence(2)],
            'meta' => [
                'seo_title' => fake()->sentence(2),
                'seo_desc' => fake()->sentence(6)
            ]
        ];
    }
}
