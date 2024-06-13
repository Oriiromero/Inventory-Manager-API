<?php

namespace Database\Seeders;

use App\Models\Supermarket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupermarketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        echo "Seeding 10 supermarkets\n";

        Supermarket::factory()
        ->count(10)
        ->create();
        $count = Supermarket::count();

        echo "Total supermarkets in DB: $count\n";
    }
}
