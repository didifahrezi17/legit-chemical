<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Chemical',
                'icon' => 'bi-beaker',
                'description' => 'Bahan kimia industri, laboratorium, dan pengolahan berkualitas tinggi.',
            ],
            [
                'name' => 'Hardware',
                'icon' => 'bi-tools',
                'description' => 'Perlengkapan hardware, aksesoris pintu, baut, dan peralatan teknik.',
            ],
            [
                'name' => 'Bahan & Bibit',
                'icon' => 'bi-tree',
                'description' => 'Bibit tanaman unggul dan bahan pendukung pertanian.',
            ],
            [
                'name' => 'Laundry',
                'icon' => 'bi-basket3',
                'description' => 'Deterjen, pelembut, dan formula pembersih pakaian usaha laundry.',
            ],
            [
                'name' => 'Home Care',
                'icon' => 'bi-house-heart',
                'description' => 'Pembersih rumah tangga, lantai, kaca, dan sanitasi lingkungan.',
            ],
            [
                'name' => 'Car Care',
                'icon' => 'bi-car-front',
                'description' => 'Shampoo mobil, pengilap bodi, pembersih interior, dan perawatan kendaraan.',
            ],
        ];

        foreach ($categories as $cat) {
            Category::updateOrCreate(
                ['slug' => Str::slug($cat['name'])],
                [
                    'name' => $cat['name'],
                    'icon' => $cat['icon'],
                    'description' => $cat['description'],
                    'status' => 'active',
                ]
            );
        }
    }
}
