<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Post>
 */
class DeliveryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'name' => fake()->name(),
            'user_id' => fake()->randomNumber(1,200),
            'tel' => fake()->phoneNumber(),
            'postal' => fake()->postcode(),
            'address'  => fake()->address(),
        ];
    }
}
