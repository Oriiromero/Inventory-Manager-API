<?php

namespace Database\Seeders;

use App\Models\PackageMove;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PackageMoveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        echo "Seeding 20 package moves\n";

        PackageMove::factory()
        ->count(10)
        ->create();

        $count = PackageMove::count();
        echo "Total package moves in DB: $count\n";
    }
}
