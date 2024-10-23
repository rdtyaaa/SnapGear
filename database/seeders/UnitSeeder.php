<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $units = [
            [
                'name' => 'Camera',
                'gambar' => '1729595313.jpg',
                'harga' => 5000000,
                'stok' => 10,
            ],
            [
                'name' => 'Tripod',
                'gambar' => '1729595313.jpg',
                'harga' => 1500000,
                'stok' => 20,
            ],
            [
                'name' => 'Lens',
                'gambar' => '1729595313.jpg',
                'harga' => 2500000,
                'stok' => 15,
            ],
            [
                'name' => 'Lighting Kit',
                'gambar' => '1729595313.jpg',
                'harga' => 3000000,
                'stok' => 5,
            ],
            [
                'name' => 'Drone',
                'gambar' => '1729595313.jpg',
                'harga' => 10000000,
                'stok' => 3,
            ],
        ];

        // Menyisipkan data ke dalam tabel units
        foreach ($units as $unit) {
            Unit::create($unit);
        }
    }
}
