<?php

namespace Database\Seeders;

use App\Models\VendorProduct;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        VendorProduct::factory()->count(50)->create();
    }
}
