<?php

namespace Database\Factories;

use App\Models\Package;
use App\Models\User;
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
            'package_id' => Package::inRandomOrder()->first()->id,
            'status' => $this->faker->randomElement(['arrived', 'in transit', 'delivered']),
            'location' => $this->faker->address,
            'handled_by' => User::inRandomOrder()->first()->id,
        ];
    }
}
