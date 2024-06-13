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
        PackageMove::factory()
        ->count(20)
        ->create();
    }
}
