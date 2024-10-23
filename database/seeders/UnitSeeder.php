<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Unit;
use App\Models\Category;

class UnitSeeder extends Seeder
{
    public function run()
    {
        Unit::factory()->count(10)->create()->each(function ($unit) {
            $categories = Category::inRandomOrder()->take(rand(1, 3))->pluck('id');
            $unit->categories()->attach($categories);
        });
    }
}