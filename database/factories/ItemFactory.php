<?php

namespace Database\Factories;

use App\Models\Type;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'image' => 'images/placeholder.jpg',
            'name' => fake()->text(20),
            'short_description' => fake()->text(100),
            'long_description' => '<p>'.fake()->text(500).'</p>',
            'price' => rand(100,50000),
            'type_id' => Type::all()->random()->id,
        ];
    }
}
