<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Laptop',
                'description' => 'High-performance laptop with 16GB RAM and 512GB SSD',
                'price' => 999.99,
                'quantity' => 15,
                'image' => 'https://via.placeholder.com/300x200?text=Laptop'
            ],
            [
                'name' => 'Smartphone',
                'description' => 'Latest model with 128GB storage and 12MP camera',
                'price' => 699.99,
                'quantity' => 25,
                'image' => 'https://via.placeholder.com/300x200?text=Smartphone'
            ],
            [
                'name' => 'Headphones',
                'description' => 'Wireless noise-cancelling headphones with 24-hour battery life',
                'price' => 199.99,
                'quantity' => 50,
                'image' => 'https://via.placeholder.com/300x200?text=Headphones'
            ],
            [
                'name' => 'Smartwatch',
                'description' => 'Fitness tracker with heart rate monitor and sleep tracking',
                'price' => 149.95,
                'quantity' => 30,
                'image' => 'https://via.placeholder.com/300x200?text=Smartwatch'
            ],
            [
                'name' => 'Tablet',
                'description' => '10-inch display with 64GB storage and 10-hour battery life',
                'price' => 349.99,
                'quantity' => 20,
                'image' => 'https://via.placeholder.com/300x200?text=Tablet'
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}