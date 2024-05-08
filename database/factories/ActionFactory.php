<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ActionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    private static $counter = 0;

    public function definition(): array
    {
        $text = '';
        for ($i=0;$i<rand(5,8);$i++) {
            $text .= '<p>'.fake()->text(rand(500,3000)).'</p>';
        }
        self::$counter++;

        return [
            'image' => 'storage/images/actions/action.jpg',
            'name' => fake()->text(50),
            'text' => $text,
            'active' => self::$counter == 1
        ];
    }
}
