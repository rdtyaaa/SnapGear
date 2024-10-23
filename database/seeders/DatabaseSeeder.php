<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\UnitSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\CategorySeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UsersTableSeeder::class,
            // CategoriesTableSeeder::class,
            // UnitsTableSeeder::class,
            // UserSeeder::class,
            CategorySeeder::class,
            UnitSeeder::class,
        ]);
    }
}
