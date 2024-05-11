<?php

namespace Database\Seeders;

use App\Models\Option;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::all();
        $options = Option::all();

        $products->each(function ($product) use ($options) {
            $product->options()->attach(
                $options->random(rand(1, 5))->pluck('id')->toArray()
            );
        });
    }
}
