<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        GenerateProductImages::generate();

        $this->call([
            AdminSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
        ]);
    }
}
