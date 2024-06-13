<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AuditLog>
 */
class AuditLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'action' => $this->faker->randomElement(['create', 'update', 'delete']),
            'target_table' => $this->faker->randomElement(['users', 'packages', 'supermarkets', 'package_movements']),
            'target_id' => $this->faker->randomNumber(),
        ];
    }
}
