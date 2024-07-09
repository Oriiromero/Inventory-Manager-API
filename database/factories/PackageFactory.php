<?php

namespace Database\Factories;

use App\Models\Supermarket;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Package>
 */
class PackageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'supermarket_id' => Supermarket::inRandomOrder()->first()->id,
            'tracking_number' => $this->faker->unique()->numerify('PKG-#######'),
            'description' => $this->faker->text,
            'weight' => $this->faker->randomFloat(2, 1, 100),
            'dimensions' => $this->faker->randomElement(['10x10x10', '20x20x20', '30x30x30']),
            'status' => $this->faker->randomElement(['arrived', 'in transit', 'delivered']),
        ];
    }
}
