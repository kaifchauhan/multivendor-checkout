<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        \App\Models\Product::insert([
            [
                'name' => 'iPhone',
                'price' => 100000,
                'stock' => 10,
                'vendor_id' => 1
            ],
            [
                'name' => 'Galaxy',
                'price' => 80000,
                'stock' => 10,
                'vendor_id' => 2
            ]
        ]);
    }
}
