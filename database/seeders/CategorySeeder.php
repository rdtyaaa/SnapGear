<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Kamera'],
            ['name' => 'Lighting'],
            ['name' => 'Canon'],
            ['name' => 'Sony'],
            ['name' => 'Fuji Film'],
            ['name' => 'Microphone'],
            ['name' => 'Videography'],
            ['name' => 'Fotography'],
        ];

        // Menyisipkan data ke dalam tabel categories
        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
