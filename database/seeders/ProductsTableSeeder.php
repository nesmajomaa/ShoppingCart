<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    Product::create([
        'name' => 'Product 1',
        'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ',
        'price' => '10',
        'quantity' => '10',
        'category_id' => '1',
        'img' => 'product_images/'.time().'_'.rand(1,10000).'.jpg',
    ]);
    Product::create([
        'name' => 'Product 2',
        'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ',
        'price' => '20',
        'quantity' => '10',
        'category_id' => '2',
        'img' => 'product_images/'.time().'_'.rand(1,10000).'.jpg',
    ]);
    Product::create([
        'name' => 'Product 3',
        'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ',
        'price' => '30',
        'quantity' => '10',
        'category_id' => '3',
        'img' => 'product_images/'.time().'_'.rand(1,10000).'.jpg',
    ]);
}
}