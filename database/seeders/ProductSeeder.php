<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Keyboard Mechanical',
                'price' => 450000,
                'description' => 'Keyboard switch blue dengan RGB backlight.',
            ],
            [
                'name' => 'Mouse Wireless',
                'price' => 175000,
                'description' => 'Mouse 2.4G dengan baterai tahan lama.',
            ],
            [
                'name' => 'Monitor 24 Inch',
                'price' => 1850000,
                'description' => 'Panel IPS Full HD 75Hz.',
            ],
            [
                'name' => 'Laptop Stand',
                'price' => 120000,
                'description' => null,
            ],
            [
                'name' => 'USB-C Hub',
                'price' => 250000,
                'description' => 'Hub 6-in-1 untuk laptop modern.',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
