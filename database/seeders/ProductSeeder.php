<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'name' => 'Laptop Asus',
            'price' => 8500000,
            'description' => 'Laptop untuk kebutuhan kantor dan kuliah',
            'stock' => 10,
        ]);

        Product::create([
            'name' => 'Mouse Logitech',
            'price' => 150000,
            'description' => 'Mouse wireless nyaman digunakan',
            'stock' => 50,
        ]);
    }
}