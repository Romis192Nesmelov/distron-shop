<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $text = '';
        for ($i=0;$i<rand(3,7);$i++) {
            $text .= '<p>'.fake()->text(rand(500,3000)).'</p>';
        }

        return [
            'image' => 'storage/images/placeholder.jpg',
            'name' => fake()->text(rand(10,50)),
            'short' => fake()->text(255),
            'text' => $text
        ];
    }
}
