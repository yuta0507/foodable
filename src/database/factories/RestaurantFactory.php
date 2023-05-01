<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class RestaurantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => function () {
                return User::factory()->create()->id;
            },
            'name' => fake()->name(),
            'genre' => fake()->name(),
            'area' => fake()->name(),
            'url' => fake()->url(),
            'takeaway_flag' => fake()->numberBetween(0, 2),
            'user_review' => fake()->numberBetween(0, 5),
            'google_review' => fake()->numberBetween(0, 5),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => []);
    }
}
