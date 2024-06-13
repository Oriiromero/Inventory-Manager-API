<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PackageMove>
 */
class PackageMoveFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'package_id' => \App\Models\Package::factory(),
            'status' => $this->faker->randomElement(['arrived', 'in transit', 'delivered']),
            'location' => $this->faker->address,
            'handled_by' => \App\Models\User::factory(),
        ];
    }
}
