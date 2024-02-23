<?php

namespace Database\Factories;

use App\Models\VendorProduct;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VendorProduct>
 */
class VendorProductFactory extends Factory
{
//    protected $model = VendorProduct::class;

    public function definition()
    {
        return [
            'vendor_id' => \App\Models\Vendor::factory(),
            'product_id' => \App\Models\Product::factory(),
        ];
    }
}
