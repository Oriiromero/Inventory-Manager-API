<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        echo "Running DatabaseSeeder\n";

        $this->call([
            UserSeeder::class,
            SupermarketSeeder::class,
            PackageSeeder::class,
            PackageMoveSeeder::class,
            AuditLogSeeder::class,
        ]);

        echo "DatabaseSeeder completed\n";
    }
}
