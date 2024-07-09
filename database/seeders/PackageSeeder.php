<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        echo "Seeding 25 packages\n";

        Package::factory()
        ->count(25)
        ->create();

        $count = Package::count();
        echo "Total packages in DB: $count\n";
    }
}
