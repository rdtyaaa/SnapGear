<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('units')->insert([
            [
                'name' => 'Laptop',
                'gambar' => 'laptop.jpg',
                'harga' => 15000000,
                'stok' => 10,
            ],
            [
                'name' => 'Camera',
                'gambar' => 'camera.jpg',
                'harga' => 5000000,
                'stok' => 5,
            ],
            [
                'name' => 'Lightning',
                'gambar' => 'lightning.jpg',
                'harga' => 100000,
                'stok' => 50,
            ],
        ]);
    }
}